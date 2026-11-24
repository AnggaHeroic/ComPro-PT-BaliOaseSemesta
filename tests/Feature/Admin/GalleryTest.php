<?php

namespace Tests\Feature\Admin;

use App\Models\ActivityLog;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    private function makeGallery(string $title = 'Dokumentasi'): Gallery
    {
        Storage::disk('public')->put('galleries/lama.jpg', 'x');

        return Gallery::create(['title' => $title, 'description' => null, 'image' => 'galleries/lama.jpg']);
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get(route('admin.galleries.index'))->assertRedirect(route('login'));
        $this->post(route('admin.galleries.store'), [])->assertRedirect(route('login'));
    }

    public function test_admin_can_see_gallery_pages(): void
    {
        $user = User::factory()->create();
        $gallery = $this->makeGallery('Foto Kantor');

        $this->actingAs($user)->get(route('admin.galleries.index'))->assertOk()->assertSee('Foto Kantor');
        $this->actingAs($user)->get(route('admin.galleries.create'))->assertOk();
        $this->actingAs($user)->get(route('admin.galleries.edit', $gallery))->assertOk()->assertSee('Foto Kantor');
    }

    public function test_admin_can_store_gallery_with_image(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('admin.galleries.store'), [
            'title' => 'Acara Perusahaan',
            'description' => 'Deskripsi singkat',
            'image' => UploadedFile::fake()->image('foto.jpg'),
        ])->assertRedirect(route('admin.galleries.index'))->assertSessionHas('success');

        $gallery = Gallery::firstOrFail();
        $this->assertSame('Acara Perusahaan', $gallery->title);
        Storage::disk('public')->assertExists($gallery->image);
        $this->assertDatabaseHas('activity_logs', ['action' => 'created', 'subject_id' => $gallery->id, 'user_id' => $user->id]);
    }

    public function test_store_validates_required_fields_and_image_type(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('admin.galleries.store'), [])
            ->assertSessionHasErrors(['title', 'image']);

        $this->actingAs($user)->post(route('admin.galleries.store'), [
            'title' => 'X',
            'image' => UploadedFile::fake()->create('dokumen.pdf', 10, 'application/pdf'),
        ])->assertSessionHasErrors('image');

        $this->assertSame(0, Gallery::count());
    }

    public function test_update_without_new_image_keeps_old_file(): void
    {
        $user = User::factory()->create();
        $gallery = $this->makeGallery();

        $this->actingAs($user)->put(route('admin.galleries.update', $gallery), ['title' => 'Judul Baru'])
            ->assertRedirect(route('admin.galleries.index'));

        $this->assertSame('Judul Baru', $gallery->fresh()->title);
        Storage::disk('public')->assertExists('galleries/lama.jpg');
        $this->assertDatabaseHas('activity_logs', ['action' => 'updated', 'subject_id' => $gallery->id]);
    }

    public function test_update_with_new_image_replaces_old_file(): void
    {
        $user = User::factory()->create();
        $gallery = $this->makeGallery();

        $this->actingAs($user)->put(route('admin.galleries.update', $gallery), [
            'title' => 'Dokumentasi',
            'image' => UploadedFile::fake()->image('baru.png'),
        ])->assertRedirect(route('admin.galleries.index'));

        $fresh = $gallery->fresh();
        $this->assertNotSame('galleries/lama.jpg', $fresh->image);
        Storage::disk('public')->assertExists($fresh->image);
        Storage::disk('public')->assertMissing('galleries/lama.jpg');
    }

    public function test_admin_can_delete_gallery_and_its_file(): void
    {
        $user = User::factory()->create();
        $gallery = $this->makeGallery();

        $this->actingAs($user)->delete(route('admin.galleries.destroy', $gallery))
            ->assertRedirect(route('admin.galleries.index'));

        $this->assertModelMissing($gallery);
        Storage::disk('public')->assertMissing('galleries/lama.jpg');
        $this->assertSame(1, ActivityLog::where('action', 'deleted')->count());
    }

    public function test_activity_log_itself_is_not_logged(): void
    {
        $this->makeGallery();

        // Satu log "created" milik Gallery; ActivityLog tidak mencatat dirinya (tanpa rekursi).
        $this->assertSame(1, ActivityLog::count());
    }
}

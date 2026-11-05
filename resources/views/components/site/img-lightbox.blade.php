@props(['images' => []])
{{-- Pratinjau foto dokumentasi layar penuh (Alpine: komponen `documentationLightbox` di resources/js/lightbox.js).
     Dibuka lewat event window `documentation-open` ({ index }). Mendukung zoom (tombol, roda mouse, klik ganda, pinch),
     geser saat diperbesar, navigasi panah keyboard, Esc untuk menutup, dan penghitung foto. --}}
<div
    x-data="documentationLightbox(@js($images))"
    @documentation-open.window="openPreview($event.detail.index, $event.detail.images)"
    @keydown.escape.window="closePreview()"
    @keydown.arrow-right.window="preview && nextPreview()"
    @keydown.arrow-left.window="preview && previousPreview()"
>
    <div
        x-show="preview"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-[70] flex items-center justify-center bg-navy-dark/95 p-4 sm:p-8"
        role="dialog"
        aria-modal="true"
        aria-label="Pratinjau dokumentasi"
        @click.self="closePreview()"
    >
        <button type="button" @click="closePreview()" aria-label="Tutup pratinjau"
                class="absolute right-5 top-5 z-10 inline-flex size-11 items-center justify-center text-white/70 transition-colors hover:text-white sm:right-8 sm:top-8">
            <x-icon name="close" class="size-6" />
        </button>

        <button type="button" @click.stop="previousPreview()" aria-label="Dokumentasi sebelumnya"
                class="absolute left-3 top-1/2 z-10 inline-flex size-11 -translate-y-1/2 items-center justify-center text-white/70 transition-colors hover:text-white sm:left-6">
            <x-icon name="arrow-left" class="size-6" />
        </button>

        <div class="flex max-h-full max-w-[90vw] flex-col items-center" @click.stop>
            <div
                class="relative flex max-h-[80vh] max-w-[90vw] items-center justify-center overflow-hidden border-t-2 border-brand"
                @wheel.prevent="handleWheel($event)"
                @pointerdown="handlePointerDown($event)"
                @pointermove="handlePointerMove($event)"
                @pointerup="handlePointerUp($event)"
                @pointercancel="handlePointerUp($event)"
                @pointerleave="handlePointerUp($event)"
                @dblclick.prevent.stop="toggleZoom()"
            >
                <img
                    x-ref="previewImage"
                    :src="images[previewIndex]"
                    :alt="'Dokumentasi ' + (previewIndex + 1)"
                    draggable="false"
                    class="max-h-[80vh] max-w-[90vw] select-none object-contain"
                    :class="zoom > 1 ? 'cursor-grab active:cursor-grabbing' : 'cursor-zoom-in'"
                    :style="`transform: translate(${translateX}px, ${translateY}px) scale(${zoom}); transition: ${isDragging ? 'none' : 'transform 200ms ease-out'}; touch-action: none; transform-origin: center center;`"
                >
            </div>

            <div class="mt-4 flex items-center gap-4">
                <button type="button" @click="zoomOut()" :disabled="zoom <= minZoom" aria-label="Perkecil gambar"
                        class="inline-flex size-9 items-center justify-center text-white/70 transition-colors hover:text-white disabled:pointer-events-none disabled:opacity-30">
                    <x-icon name="zoom-out" class="size-5" />
                </button>

                <button type="button" @click="toggleZoom()" :aria-label="zoom > 1 ? 'Reset zoom' : 'Perbesar gambar'"
                        class="min-w-[42px] font-display text-xs font-semibold tracking-[0.12em] text-white/70 transition-colors hover:text-white">
                    <span x-text="`${Math.round(zoom * 100)}%`"></span>
                </button>

                <button type="button" @click="zoomIn()" :disabled="zoom >= maxZoom" aria-label="Perbesar gambar"
                        class="inline-flex size-9 items-center justify-center text-white/70 transition-colors hover:text-white disabled:pointer-events-none disabled:opacity-30">
                    <x-icon name="zoom-in" class="size-5" />
                </button>

                <span class="h-4 w-px bg-white/20" aria-hidden="true"></span>

                <div class="font-display text-xs font-semibold tracking-[0.15em] text-white/60" aria-live="polite">
                    <span x-text="previewIndex + 1"></span> / <span x-text="images.length"></span>
                </div>
            </div>
        </div>

        <button type="button" @click.stop="nextPreview()" aria-label="Dokumentasi berikutnya"
                class="absolute right-3 top-1/2 z-10 inline-flex size-11 -translate-y-1/2 items-center justify-center text-white/70 transition-colors hover:text-white sm:right-6">
            <x-icon name="arrow-right" class="size-6" />
        </button>
    </div>
</div>

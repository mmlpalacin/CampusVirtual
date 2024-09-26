<div wire:ignore>
    <textarea wire:model="body" class="form-control required" name="message" id="message"></textarea>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.swiper-container').forEach(container => {
            new Swiper(container, {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: container.querySelector('.swiper-pagination'),
                    clickable: true,
                },
            });
        });
    });
</script>
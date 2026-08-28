"use strict";

var notyf = new Notyf();

jQuery(document).ready(function ($) {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

    $(".add-cart").on("click", function (e) {
        e.preventDefault();

        const id = $(this).data("id");

        $.ajax({
            method: "POST",
            url: route("cart.store", id),
            data: {
                _token: csrfToken,
            },
            beforeSend: function () {
                $(`#cart-btn-${id}`).text("Adding...");
            },
            success: function (data) {
                if (data.success) {
                    $(`#cart-count`).text(data.cart_count);
                    notyf.success(data.message);
                    $(`#cart-btn-${id}`).text("Add To Cart");
                }
            },
            error: function (xhr, status, error) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    $(`#cart-btn-${id}`).text("Add To Cart");
                    notyf.error(xhr.responseJSON.message);
                }
            },
        });
    });

    // Remove Cart Item

    $(`.cart-item-remove`).on("click", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        $.ajax({
            method: "DELETE",
            url: route("cart.delete", id),
            data: {
                _token: csrfToken,
            },

            success: function (data) {
                if (data.status=='success') {
                    window.location.reload();
                }
            },
            error: function (xhr, status, error) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    notyf.error(xhr.responseJSON.message);
                }
            },
        });
    });
});

   document.addEventListener("DOMContentLoaded", function () {
        const players = new Map();
        const hoverTimers = new Map(); // Store timeout IDs for each video

        document.querySelectorAll(".player").forEach((el) => {
            const source = el.querySelector("source");
            if (source) {
                source.dataset.src = source.src; // Store actual source
                source.removeAttribute("src"); // Prevent preloading
            }

            const player = new Plyr(el, { controls: [] });
            players.set(el, player);
        });

        $(function () {
            $(".product-video").on("mouseover", function () {
                const videoElement = $(this).find(".player")[0];
                if (videoElement && players.has(videoElement)) {
                    // Set a delay before loading the video
                    const timeoutId = setTimeout(() => {
                        const player = players.get(videoElement);
                        const source = videoElement.querySelector("source");
                        if (source && !videoElement.getAttribute("src")) {
                            source.setAttribute("src", source.dataset.src);
                            videoElement.load();
                        }
                        player.muted = true;
                        player.play();
                    }, 500); // Delay of 500ms

                    hoverTimers.set(videoElement, timeoutId);
                }
            });

            $(".product-video").on("mouseout", function () {
                const videoElement = $(this).find(".player")[0];
                if (videoElement && players.has(videoElement)) {
                    const player = players.get(videoElement);
                    player.pause();

                    // Clear the timeout if the user moves away before loading
                    if (hoverTimers.has(videoElement)) {
                        clearTimeout(hoverTimers.get(videoElement));
                        hoverTimers.delete(videoElement);
                    }
                }
            });
        });
    });

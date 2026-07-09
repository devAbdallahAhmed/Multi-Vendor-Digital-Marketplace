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

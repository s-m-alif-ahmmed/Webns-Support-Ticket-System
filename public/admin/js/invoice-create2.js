// Company Invoice

(() => {
    "use strict";
    var e, t, n, c, i;

    function m() {
        $(".select2-show-search").select2({
            minimumResultsForSearch: "",
            width: "100%"
        })
    }

    function o(e) {
        return e.id ? $('<span><img src="https://laravel8.spruko.com/noa/assets/images/users/' + e.element.value.toLowerCase() + '.jpg" class="rounded-circle avatar-sm" /> ' + e.text + "</span>") : e.text
    }
    e = document.querySelector("#company-shipping-address"), (t = document.querySelector("#addCompanyShippingAddress")).addEventListener("click", (function () {
        e.classList.contains("d-none") ? e.classList.remove("d-none") : e.classList.add("d-none"), t.classList.add("d-none")
    })), c = document.querySelector(".company-product-description-list"), i = document.querySelector(".company-product-description-each"),
        function () {
            function e(e) {
                c.removeChild(e.target.parentElement)
            }
            setInterval((function () {
                setTimeout((function () {
                    for (var t = document.querySelectorAll(".company-delete-row-btn"), n = 0; n < t.length; n++) t[n].addEventListener("click", e)
                }), 1)
            }), 1)
        }(), n = i.cloneNode(!0), document.querySelector(".add-company-invoice-item-btn").addEventListener("click", (function () {
        var e = n.cloneNode(!0);
        c.appendChild(e), m()
    }))
})();

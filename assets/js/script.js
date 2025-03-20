$(document).ready(function () {
    var $wrapper = $('.main-wrapper'); var $slimScrolls = $('.slimscroll'); var $pageWrapper = $('.page-wrapper'); feather.replace(); $(window).resize(function () { if ($('.page-wrapper').length > 0) { var height = $(window).height(); $(".page-wrapper").css("min-height", height); } }); $('body').append('<div class="sidebar-overlay"></div>'); $(document).on('click', '#mobile_btn', function () { $wrapper.toggleClass('slide-nav'); $('.sidebar-overlay').toggleClass('opened'); $('html').addClass('menu-opened'); $('#task_window').removeClass('opened'); return false; }); $(".sidebar-overlay").on("click", function () { $('html').removeClass('menu-opened'); $(this).removeClass('opened'); $wrapper.removeClass('slide-nav'); $('.sidebar-overlay').removeClass('opened'); $('#task_window').removeClass('opened'); }); $(document).on("click", ".hideset", function () { $(this).parent().parent().parent().hide(); }); $(document).on("click", ".delete-set", function () { $(this).parent().parent().hide(); }); if ($('.product-slide').length > 0) { $('.product-slide').owlCarousel({ items: 1, margin: 30, dots: false, nav: true, loop: false, responsiveClass: true, responsive: { 0: { items: 1 }, 800: { items: 1 }, 1170: { items: 1 } } }); }
    if ($('.owl-product').length > 0) { var owl = $('.owl-product'); owl.owlCarousel({ margin: 10, dots: false, nav: true, loop: false, touchDrag: false, mouseDrag: false, responsive: { 0: { items: 2 }, 768: { items: 4 }, 1170: { items: 8 } } }); }
    if ($(".datanew").length > 0) { var table = $(".datanew").DataTable({ sDom: "fBtlpi", buttons: [{ extend: "pdfHtml5", text: "PDF", titleAttr: "Export to PDF", className: "pdfBtn d-none" }, { extend: "excelHtml5", text: "Excel", titleAttr: "Export to Excel", className: "excelBtn d-none" }, { extend: "print", text: "Print", titleAttr: "Print", className: "printBtn d-none" }], bFilter: true, pagingType: "numbers", ordering: true, order: [], columnDefs: [{ orderable: false, targets: [0, -1] }], drawCallback: function () { $("#brandTable td").removeClass("sorting"); }, "language": { "search": ' ', "sLengthMenu": '_MENU_', "searchPlaceholder": "Search...", "info": "_START_ - _END_ of _TOTAL_ items" }, "initComplete": function (settings, json) { $('.dataTables_filter').appendTo('#tableSearch'); $('.dataTables_filter').appendTo('.search-input'); }, }); $(".wordset ul li:eq(0) a").on("click", function (e) { e.preventDefault(), table.button(".pdfBtn").trigger(); }); $(".wordset ul li:eq(1) a").on("click", function (e) { e.preventDefault(), table.button(".excelBtn").trigger(); }); $(".wordset ul li:eq(2) a").on("click", function (e) { e.preventDefault(), table.button(".printBtn").trigger(); }); }
    if($(".datanew-report").length>0){$(".datanew-report").each(function(e,t){var a=$(t).DataTable({sDom:"fBtlpi",buttons:[{extend:"pdfHtml5",text:"PDF",titleAttr:"Export to PDF",className:"pdfBtn d-none",exportOptions:{columns:":visible",modifier:{search:"applied"}}},{extend:"excelHtml5",text:"Excel",titleAttr:"Export to Excel",className:"excelBtn d-none",exportOptions:{columns:":visible",modifier:{search:"applied"}}},{extend:"print",text:"Print",titleAttr:"Print",className:"printBtn d-none",exportOptions:{columns:":visible",modifier:{search:"applied"}}}],bFilter:true,pagingType:"numbers",ordering:true,order:[],drawCallback:function(){$(t).find("td").removeClass("sorting")},language:{search:" ",sLengthMenu:"_MENU_",searchPlaceholder:"Search...",info:"_START_ - _END_ of _TOTAL_ items"},initComplete:function(){var n=$(this).closest(".dataTables_wrapper").find(".dataTables_filter");n.clone(true,true).appendTo("#tableSearch");n.appendTo(".search-input")}});var n=$(t).closest(".tab-pane").find(".wordset ul li");n.eq(0).find("a").on("click",function(e){e.preventDefault(),a.button(".pdfBtn").trigger()}),n.eq(1).find("a").on("click",function(e){e.preventDefault(),a.button(".excelBtn").trigger()}),n.eq(2).find("a").on("click",function(e){e.preventDefault(),a.button(".printBtn").trigger()})})}
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader(); reader.onload = function (e) { $('#blah').attr('src', e.target.result); }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function () { readURL(this); }); if ($('.datatable').length > 0) { $('.datatable').DataTable({ "bFilter": false }); }
    setTimeout(function () { $('#global-loader'); setTimeout(function () { $("#global-loader").fadeOut("slow"); }, 100); }, 500); if ($('.datetimepicker').length > 0) { $('.datetimepicker').datetimepicker({ format: 'DD-MM-YYYY', icons: { up: "fas fa-angle-up", down: "fas fa-angle-down", next: 'fas fa-angle-right', previous: 'fas fa-angle-left' } }); }
    if ($('.toggle-password').length > 0) { $(document).on('click', '.toggle-password', function () { $(this).toggleClass("fa-eye fa-eye-slash"); var input = $(".pass-input"); if (input.attr("type") == "password") { input.attr("type", "text"); } else { input.attr("type", "password"); } }); }
    if ($('.toggle-passwords').length > 0) { $(document).on('click', '.toggle-passwords', function () { $(this).toggleClass("fa-eye fa-eye-slash"); var input = $(".pass-inputs"); if (input.attr("type") == "password") { input.attr("type", "text"); } else { input.attr("type", "password"); } }); }
    if ($('.toggle-passworda').length > 0) { $(document).on('click', '.toggle-passworda', function () { $(this).toggleClass("fa-eye fa-eye-slash"); var input = $(".pass-inputs"); if (input.attr("type") == "password") { input.attr("type", "text"); } else { input.attr("type", "password"); } }); }
    if ($('.select').length > 0) { $('.select').select2({ minimumResultsForSearch: -1, width: '100%' }); }
    if ($('.counter').length > 0) { $('.counter').counterUp({ delay: 20, time: 2000 }); }
    if ($('#timer-countdown').length > 0) { $('#timer-countdown').countdown({ from: 180, to: 0, movingUnit: 1000, timerEnd: undefined, outputPattern: '$day Day $hour : $minute : $second', autostart: true }); }
    if ($('#timer-countup').length > 0) { $('#timer-countup').countdown({ from: 0, to: 180 }); }
    if ($('#timer-countinbetween').length > 0) { $('#timer-countinbetween').countdown({ from: 30, to: 20 }); }
    if ($('#timer-countercallback').length > 0) { $('#timer-countercallback').countdown({ from: 10, to: 0, timerEnd: function () { this.css({ 'text-decoration': 'line-through' }).animate({ 'opacity': .5 }, 500); } }); }
    if ($('#timer-outputpattern').length > 0) { $('#timer-outputpattern').countdown({ outputPattern: '$day Days $hour Hour $minute Min $second Sec..', from: 60 * 60 * 24 * 3 }); }
    if ($('#summernote').length > 0) { $('#summernote').summernote({ height: 300, minHeight: null, maxHeight: null, focus: true }); }
    if ($slimScrolls.length > 0) { $slimScrolls.slimScroll({ height: 'auto', width: '100%', position: 'right', size: '7px', color: '#ccc', wheelStep: 10, touchScrollStep: 100 }); var wHeight = $(window).height() - 60; $slimScrolls.height(wHeight); $('.sidebar .slimScrollDiv').height(wHeight); $(window).resize(function () { var rHeight = $(window).height() - 60; $slimScrolls.height(rHeight); $('.sidebar .slimScrollDiv').height(rHeight); }); }
    var Sidemenu = function () { this.$menuItem = $('#sidebar-menu a'); }; function init() {
        var $this = Sidemenu; $('#sidebar-menu a').on('click', function (e) {
            if ($(this).parent().hasClass('submenu')) { e.preventDefault(); }
            if (!$(this).hasClass('subdrop')) { $('ul', $(this).parents('ul:first')).slideUp(250); $('a', $(this).parents('ul:first')).removeClass('subdrop'); $(this).next('ul').slideDown(350); $(this).addClass('subdrop'); } else if ($(this).hasClass('subdrop')) { $(this).removeClass('subdrop'); $(this).next('ul').slideUp(350); }
        }); $('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
    }
    init(); $(document).on('mouseover', function (e) {
        e.stopPropagation(); if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
            var targ = $(e.target).closest('.sidebar, .header-left').length; if (targ) { $('body').addClass('expand-menu'); $('.subdrop + ul').slideDown(); } else { $('body').removeClass('expand-menu'); $('.subdrop + ul').slideUp(); }
            return false;
        }
    }); $(document).on('click', '#toggle_btn', function () {
        if ($('body').hasClass('mini-sidebar')) { $('body').removeClass('mini-sidebar'); $(this).addClass('active'); $('.subdrop + ul').slideDown(); localStorage.setItem('screenModeNightTokenState', 'night'); setTimeout(function () { $("body").removeClass("mini-sidebar"); $(".header-left").addClass("active"); }, 100); } else { $('body').addClass('mini-sidebar'); $(this).removeClass('active'); $('.subdrop + ul').slideUp(); localStorage.removeItem('screenModeNightTokenState', 'night'); setTimeout(function () { $("body").addClass("mini-sidebar"); $(".header-left").removeClass("active"); }, 100); }
        return false;
    }); if (localStorage.getItem('screenModeNightTokenState') == 'night') { setTimeout(function () { $("body").removeClass("mini-sidebar"); $(".header-left").addClass("active"); }, 100); }
    $('.submenus').on('click', function () { $('body').addClass('sidebarrightmenu'); }); $('#searchdiv').on('click', function () { $('.searchinputs').addClass('show'); }); $('.search-addon span').on('click', function () { $('.searchinputs').removeClass('show'); }); $(document).on('click', '#filter_search', function () { $('#filter_inputs').slideToggle("slow"); }); $(document).on('click', '#filter_search1', function () { $('#filter_inputs1').slideToggle("slow"); }); $(document).on('click', '#filter_search2', function () { $('#filter_inputs2').slideToggle("slow"); }); $(document).on('click', '#filter_search', function () { $('#filter_search').toggleClass("setclose"); }); $(document).on('click', '#filter_search1', function () { $('#filter_search1').toggleClass("setclose"); }); $(document).on("click", ".productset", function () { $(this).toggleClass("active"); }); $('.inc.button').click(function () { var $this = $(this), $input = $this.prev('input'), $parent = $input.closest('div'), newValue = parseInt($input.val()) + 1; $parent.find('.inc').addClass('a' + newValue); $input.val(newValue); newValue += newValue; }); $('.dec.button').click(function () { var $this = $(this), $input = $this.next('input'), $parent = $input.closest('div'), newValue = parseInt($input.val()) - 1; console.log($parent); $parent.find('.inc').addClass('a' + newValue); $input.val(newValue); newValue += newValue; }); if ($('.custom-file-container').length > 0) {
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        var secondUpload = new FileUploadWithPreview('mySecondImage')
    }
    $('.counters').each(function () { var $this = $(this), countTo = $this.attr('data-count'); $({ countNum: $this.text() }).animate({ countNum: countTo }, { duration: 2000, easing: 'linear', step: function () { $this.text(Math.floor(this.countNum)); }, complete: function () { $this.text(this.countNum); } }); }); if ($('.toggle-password').length > 0) { $(document).on('click', '.toggle-password', function () { $(this).toggleClass("fa-eye fa-eye"); var input = $(".pass-input"); if (input.attr("type") == "text") { input.attr("type", "text"); } else { input.attr("type", "password"); } }); }
    if ($('.win-maximize').length > 0) { $('.win-maximize').on('click', function (e) { if (!document.fullscreenElement) { document.documentElement.requestFullscreen(); } else { if (document.exitFullscreen) { document.exitFullscreen(); } } }) }
    $(document).on('click', '#check_all', function () { $('.checkmail').click(); return false; }); if ($('.checkmail').length > 0) { $('.checkmail').each(function () { $(this).on('click', function () { if ($(this).closest('tr').hasClass('checked')) { $(this).closest('tr').removeClass('checked'); } else { $(this).closest('tr').addClass('checked'); } }); }); }
    if ($('.popover-list').length > 0) {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) { return new bootstrap.Popover(popoverTriggerEl) })
    }
    if ($('.clipboard').length > 0) { var clipboard = new Clipboard('.btn'); }
    var chatAppTarget = $('.chat-window'); (function () {
        if ($(window).width() > 991)
            chatAppTarget.removeClass('chat-slide'); $(document).on("click", ".chat-window .chat-users-list a.media", function () {
                if ($(window).width() <= 991) { chatAppTarget.addClass('chat-slide'); }
                return false;
            }); $(document).on("click", "#back_user_list", function () {
                if ($(window).width() <= 991) { chatAppTarget.removeClass('chat-slide'); }
                return false;
            });
    })(); $(document).on('click', '.mail-important', function () { $(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o'); }); var selectAllItems = "#select-all"; var checkboxItem = ":checkbox"; $(selectAllItems).click(function () { if (this.checked) { $(checkboxItem).each(function () { this.checked = true; }); } else { $(checkboxItem).each(function () { this.checked = false; }); } }); if ($('[data-bs-toggle="tooltip"]').length > 0) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) })
    }
    var right_side_views = '<div class="right-side-views d-none">' +
        '<ul class="sticky-sidebar siderbar-view">' +
        '<li class="sidebar-icons">' +
        '<a class="toggle tipinfo open-layout open-siderbar" href="javascript:void(0);" data-toggle="tooltip" data-placement="left" data-bs-original-title="Tooltip on left">' +
        '<div class="tooltip-five ">' +
        '<img src="assets/img/icons/siderbar-icon2.svg" class="feather-five" alt="">' +
        '<span class="tooltiptext">Check Layout</span>' +
        '</div>' +
        '</a>' +
        '</li>' +
        '</ul>' +
        '</div>' +
        '<div class="sidebar-layout">' +
        '<div class="sidebar-content">' +
        '<div class="sidebar-top">' +
        '<div class="container-fluid">' +
        '<div class="row align-items-center">' +
        '<div class="col-xl-6 col-sm-6 col-12">' +
        '<div class="sidebar-logo">' +
        '<a href="index.html" class="logo">' +
        '<img src="assets/img/logo.png" alt="Logo" class="img-flex">' +
        '</a>' +
        '</div>' +
        '</div>' +
        '<div class="col-xl-6 col-sm-6 col-12">' +
        '<a class="btn-closed" href="javascript:void(0);"><img class="img-fliud" src="assets/img/icons/sidebar-delete-icon.svg" alt="demo"></a>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="container-fluid">' +
        '<div class="row align-items-center">' +
        '<h5 class="sidebar-title">Choose layout</h5>' +
        '<div class="col-xl-12 col-sm-6 col-12">' +
        '<div class="sidebar-image align-center">' +
        '<img class="img-fliud" src="assets/img/demo-one.png" alt="demo">' +
        '</div>' +
        '<div class="row">' +
        '<div class="col-lg-6 layout">' +
        '<h5 class="layout-title">Dark Mode</h5>' +
        '</div>' +
        '<div class="col-lg-6 layout dark-mode">' +
        '<label class="toggle-switch" for="notification_switch3">' +
        '<span>' +
        '<input type="checkbox" class="toggle-switch-input" id="notification_switch3">' +
        '<span class="toggle-switch-label ms-auto">' +
        '	<span class="toggle-switch-indicator"></span>' +
        '</span>' +
        '</span>' +
        ' </label>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        $("body").append(right_side_views); $('.open-layout').on("click", function (s) { s.preventDefault(); $('.sidebar-layout').addClass('show-layout'); $('.sidebar-settings').removeClass('show-settings'); }); $('.btn-closed').on("click", function (s) { s.preventDefault(); $('.sidebar-layout').removeClass('show-layout'); }); $('.open-settings').on("click", function (s) { s.preventDefault(); $('.sidebar-settings').addClass('show-settings'); $('.sidebar-layout').removeClass('show-layout'); }); $('.btn-closed').on("click", function (s) { s.preventDefault(); $('.sidebar-settings').removeClass('show-settings'); }); $('.open-siderbar').on("click", function (s) { s.preventDefault(); $('.siderbar-view').addClass('show-sidebar'); }); $('.btn-closed').on("click", function (s) { s.preventDefault(); $('.siderbar-view').removeClass('show-sidebar'); }); if ($('.toggle-switch').length > 0) {
            const toggleSwitch = document.querySelector('.toggle-switch input[type="checkbox"]'); const currentTheme = localStorage.getItem('theme'); var app = document.getElementsByTagName("BODY")[0]; if (currentTheme) { app.setAttribute('data-theme', currentTheme); if (currentTheme === 'dark') { toggleSwitch.checked = true; } }
            function switchTheme(e) {
                if (e.target.checked) { app.setAttribute('data-theme', 'dark'); localStorage.setItem('theme', 'dark'); }
                else { app.setAttribute('data-theme', 'light'); localStorage.setItem('theme', 'light'); }
            }
            toggleSwitch.addEventListener('change', switchTheme, false);
        }
    if (window.location.hash == "#LightMode") { localStorage.setItem('theme', 'dark'); }
    else { if (window.location.hash == "#DarkMode") { localStorage.setItem('theme', 'light'); } }
    $('ul.tabs li').click(function () { var $this = $(this); var $theTab = $(this).attr('id'); console.log($theTab); if ($this.hasClass('active')) { } else { $this.closest('.tabs_wrapper').find('ul.tabs li, .tabs_container .tab_content').removeClass('active'); $('.tabs_container .tab_content[data-tab="' + $theTab + '"], ul.tabs li[id="' + $theTab + '"]').addClass('active'); } });
});
document.addEventListener("DOMContentLoaded", function () { let e = window.location.pathname; document.querySelectorAll("#sidebar-menu a").forEach(function (t) { if (t.href.includes(e)) { let c = t.closest("li"); if (c && (c.classList.add("active"), c.closest(".submenu"))) { let s = c.closest(".submenu"); s.classList.add("active"), s.querySelector(".menu-arrow").classList.add("open") } } }) });
function previewImage(input, previewId) { var file = input.files[0]; if (file) { var reader = new FileReader(); reader.onload = function (e) { document.getElementById(previewId).src = e.target.result; }; reader.readAsDataURL(file); } }

function fillProduct(productName, price, currencySymbol) {
    // console.log("Selected Product!!!:", productName, price, currencySymbol);
    // Set the selected product name in the input field
    $('#search').val(productName);
    // Hide the dropdown list
    $('#display').hide();
    // Add the selected product to the table with correct tax
    addProductToTable(productName, price, currencySymbol);
}
$(document).ready(function () {
    $("#search").keyup(function () {
        var name = $('#search').val().trim(); // Trim spaces
        if (name === "") {
            $("#display").html("").hide();
        } else {
            $.ajax({
                url: "../../admin/sale/ajax.php",
                type: "POST",
                data: { search: name },
                success: function (response) {
                    $("#display").html(response).show();
                }
            });
        }
    });
    // Prevent input from being cleared after selection
    $("#search").on("focus", function () {
        $(this).val($(this).val());
    });

    // Event listener for input changes
    $(document).on("input", "input[name='discount'], input[name='shipping']", updateTotals);
    $(document).on("change", "select[name='tax_id']", updateTotals);
    // Event listener for updating subtotal when quantity changes
    $(document).on("input", ".qty", function () {
        var row = $(this).closest("tr");
        var price = parseFloat(row.find(".price").text());
        var qty = parseInt($(this).val()) || 1;
        var subtotal = price * qty;
        row.find(".subtotal").text(subtotal.toFixed(2));

        // Update total calculations
        updateTotals();
    });
    $(document).on("click", ".delete-set", function () {
        $(this).closest("tr").remove();
        updateTotals();
    });
    // Check if sale data exists (this should be set from PHP)
    if (typeof saleData !== "undefined") {
        // Populate discount, shipping, and tax values
        $("input[name='discount']").val(saleData.discount);
        $("input[name='shipping']").val(saleData.shipping);
        $("select[name='tax_id']").val(saleData.tax_id);
        // Populate sale items in the table
        saleData.items.forEach(item => {
            addProductToTable(item.product_name, item.price, saleData.currencySymbol);
            // Update the quantity field after adding the row
            let lastRow = $("#productTable tbody tr:last-child");
            lastRow.find(".qty").val(item.qty);
            // Update the subtotal based on quantity
            let subtotal = parseFloat(item.price) * parseInt(item.qty);
            lastRow.find(".subtotal").text(subtotal.toFixed(2));
        });
        // Update totals after populating
        updateTotals();
    }
});

function addProductToTable(productName, price, currencySymbol) {
    let exists = false;
    $("#productTable tbody tr").each(function () {
        if ($(this).find(".productname").text().trim() === productName) {
            exists = true;
            return false; // Break the loop
        }
    });

    if (!exists) {
        console.log("Adding Product:", productName, price, currencySymbol);
        var rowCount = $("#productTable tbody tr").length + 1;
        var deleteIconUrl = siteUrl + "assets/img/icons/delete.svg";
        var newRow = `
            <tr>
                <td>${rowCount}</td>
                <td><span class="productname">${productName}</span></td> 
                <td>${currencySymbol} <span class="price">${price}</span></td>
                <td><input type="number" name="sale-qty" class="form-control qty" style="width:100px;" value="1" min="1"></td>
                <td>${currencySymbol} <span class="subtotal">${price}</span></td>
                <td><a href="javascript:void(0);" class="delete-set"><img src="${deleteIconUrl}" alt="svg"></a></td>
            </tr>
        `;
        $("#productTable tbody").append(newRow);
        updateTotals();
    }
}

function updateTotals() {
    var subtotal = 0;
    // Calculate total subtotal from all products
    $("#productTable tbody tr").each(function () {
        subtotal += parseFloat($(this).find(".subtotal").text()) || 0;
    });
    // Get Discount, Shipping, and Order Tax
    var discount = parseFloat($("input[name='discount']").val()) || 0;
    var shipping = parseFloat($("input[name='shipping']").val()) || 0;
    var taxRate = parseFloat($("select[name='tax_id'] option:selected").text().match(/\d+(\.\d+)?/)) || 0;
    // Calculate Order Tax
    var orderTax = (subtotal * taxRate) / 100;
    // Calculate Grand Total
    var grandTotal = subtotal + orderTax + shipping - discount;
    // Update UI
    $("#orderTax").text(`${orderTax.toFixed(2)} (${taxRate}%)`);
    $("#discountAmount").text(`${discount.toFixed(2)}`);
    $("#shippingAmount").text(`${shipping.toFixed(2)}`);
    $("#grandTotal").text(`${grandTotal.toFixed(2)}`);
    $("#total_amount").text(`${grandTotal.toFixed(2)}`);
}
$(document).ready(function () {
    updateTotals(); // Ensure it runs on page load
});
// Event listener for updating subtotal when quantity changes
$(document).on("input", ".qty", function () {
    var row = $(this).closest("tr");
    var price = parseFloat(row.find(".price").text());
    var qty = parseInt($(this).val());
    var subtotal = price * qty;
    row.find(".subtotal").text(subtotal.toFixed(2));
});

// $(document).ready(function () {
//     $("#saleForm").submit(function (event) {
//         // Ensure total_amount is updated before submission
//         var grandTotal = $("#grandTotal").text().trim(); // Assuming #grandTotal holds the total amount
//         $("#total_amount").val(grandTotal); // Set value to hidden input field
//         // Serialize table data into JSON
//         var saleItems = [];
//         $("#productTable tbody tr").each(function () {
//             var productName = $(this).find(".productname").text().trim();
//             var price = parseFloat($(this).find(".price").text()) || 0;
//             var qty = parseInt($(this).find(".qty").val()) || 1;
//             var subtotal = parseFloat($(this).find(".subtotal").text()) || 0;
//             saleItems.push({
//                 product: productName,
//                 price: price,
//                 qty: qty,
//                 subtotal: subtotal
//             });
//         });
//         // Store JSON data in hidden input
//         $("#sale_item_data").val(JSON.stringify(saleItems));
//     });
// });

$(document).ready(function () {
    function updateFormData(formId, totalAmountId, itemDataId, tableId) {
        $(formId).submit(function (event) {
            // Ensure total_amount is updated before submission
            var grandTotal = $(formId).find("#grandTotal").text().trim();
            $(totalAmountId).val(grandTotal);
            // Serialize table data into JSON
            var saleItems = [];
            $(tableId + " tbody tr").each(function () {
                var productName = $(this).find(".productname").text().trim();
                var price = parseFloat($(this).find(".price").text()) || 0;
                var qty = parseInt($(this).find(".qty").val()) || 1;
                var subtotal = parseFloat($(this).find(".subtotal").text()) || 0;
                saleItems.push({
                    product: productName,
                    price: price,
                    qty: qty,
                    subtotal: subtotal
                });
            });
            // Store JSON data in hidden input
            $(itemDataId).val(JSON.stringify(saleItems));
        });
    }
    // Call function for both forms
    updateFormData("#saleForm", "#total_amount", "#sale_item_data", "#productTable");
    updateFormData("#purchaseForm", "#total_amount", "#purchase_item_data", "#productTable");
});

function fill(productName, quantity) {
    console.log("Selected Product:", productName);
    $('#stock_search').val(productName);
    $('.current_stock').text(quantity);
    $('#display').hide();
}

$(document).ready(function () {
    // Fetch products dynamically
    $("#stock_search").keyup(function () {
        var name = $('#stock_search').val().trim();
        if (name === "") {
            $("#display").html("").hide();
        } else {
            $.ajax({
                url: "../../admin/adjustment/stock-ajax.php",
                type: "POST",
                data: { search: name },
                success: function (response) {
                    $("#display").html(response).show();
                }
            });
        }
    });

    // Prevent input from being cleared after selection
    $("#stock_search").on("focus", function () {
        $(this).val($(this).val());
    });
    $(document).ready(function () {
        $('#invoiceSelect').select2({
            placeholder: "Choose Invoice",
            allowClear: true
        });
    });
});

$(document).ready(function () {
    $("#filterSaleForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "fetch-report-value.php",
            type: "POST",
            data: $(this).serialize() + "&report_type=sales",
            success: function (response) {
                $("tbody").html(response);
            }
        });
    });
    $("#filterPurchaseForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "fetch-report-value.php",
            type: "POST",
            data: $(this).serialize() + "&report_type=purchases",
            success: function (response) {
                $("tbody").html(response);
            }
        });
    });
    $("#filterInvntoryForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "fetch-report-value.php",
            type: "POST",
            data: $(this).serialize() + "&report_type=inventory",
            success: function (response) {
                $("tbody").html(response);
            }
        });
    });
    $("#filterSupplierForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "fetch-report-value.php",
            type: "POST",
            data: $(this).serialize() + "&report_type=supplier",
            success: function (response) {
                $("tbody").html(response);
            }
        });
    });
    $("#filterCustomerForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "fetch-report-value.php",
            type: "POST",
            data: $(this).serialize() + "&report_type=customer",
            success: function (response) {
                $("tbody").html(response);
            }
        });
    });
    $("#filterPTaxForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "fetch-report-value.php",
            type: "POST",
            data: $(this).serialize() + "&report_type=purchase_tax",
            success: function (response) {
                $("tbody").html(response);
            }
        });
    });
    $("#filterCTaxForm").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "fetch-report-value.php",
            type: "POST",
            data: $(this).serialize() + "&report_type=sale_tax",
            success: function (response) {
                $("tbody").html(response);
            }
        });
    });
});
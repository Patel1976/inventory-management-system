$(document).ready(function () {
    $("#invoiceSelect").change(function () {
        var invoiceNumber = $(this).val();
        console.log("Invoice Number Selected:", invoiceNumber);
        if (invoiceNumber) {
            $.ajax({
                url: "sale-return-fetch.php",
                type: "POST",
                data: { invoice_number: invoiceNumber },
                dataType: "json",
                success: function (response) {
                    console.log("Response from PHP:", response);
                    var dropdown = $("#salereturnsearch");
                    dropdown.empty().append('<option value="">Select Product</option>');
                    if (Array.isArray(response) && response.length > 0) {
                        response.forEach(function (sale_items) {
                            console.log("Adding Product:", sale_items.product_name);
                            dropdown.append(`<option value="${sale_items.id}" 
                                                data-qty="${sale_items.qty}" 
                                                data-price="${sale_items.price}" 
                                                data-subtotal="${sale_items.subtotal}" 
                                                data-discount="${sale_items.discount}" 
                                                data-tax="${sale_items.tax}">
                                                ${sale_items.product_name}
                                            </option>`);
                        });
                    } else {
                        console.log("No products found in response.");
                        dropdown.append('<option value="">No products found</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        } else {
            $("#salereturnsearch").empty().append('<option value="">Select Product</option>');
        }
    });
    // Fetch and display product details when a product is selected
    $("#salereturnsearch").change(function () {
        var selectedOption = $(this).find(":selected");
        if (selectedOption.val()) {
            var productId = selectedOption.val();
            var productName = selectedOption.text().split(" - ")[0]; // Extract name
            var maxQuantity = parseInt(selectedOption.attr("data-qty")) || 1; // Maximum available quantity
            var price = parseFloat(selectedOption.attr("data-price")) || 0; // Convert to float
            var subtotal = parseFloat(selectedOption.attr("data-subtotal")) || 0;
            var discount = parseFloat(selectedOption.attr("data-discount")) || 0;
            var discountPerUnit = discount / maxQuantity; // Calculate discount per unit
            var totalTax = parseFloat(selectedOption.attr("data-tax")) || 0;
            var taxPerUnit = totalTax / maxQuantity; // Calculate tax per unit
            var deleteIconUrl = siteUrl + "assets/img/icons/delete.svg";
            var productRow = `<tr>
                                <td>${productName}</td>
                                <td><input type="number" class="form-control return-qty" style="width:100px;" min="1" max="${maxQuantity}" value="1"></td>
                                <td class="price">${price.toFixed(2)}</td>
                                <td class="discount" data-discount-per-unit="${discountPerUnit.toFixed(2)}">${discountPerUnit.toFixed(2)}</td>
                                <td class="tax" data-tax-per-unit="${taxPerUnit.toFixed(2)}">${taxPerUnit.toFixed(2)}</td>
                                <td class="subtotal">${(price + taxPerUnit - discountPerUnit).toFixed(2)}</td>
                                <td><a href="javascript:void(0);" class="delete-set"><img src="${deleteIconUrl}" alt="svg"></a></td>
                            </tr>`;
            $("#saleReturnTable").append(productRow);
            // Update Total Amount to Pay
            updateTotalAmount();
        }
    });
    // Handle quantity change and recalculate tax and subtotal
    $(document).on("input", ".return-qty", function () {
        var row = $(this).closest("tr");
        var quantity = parseInt($(this).val()) || 1;
        var maxQuantity = parseInt($(this).attr("max")) || 1;
        var price = parseFloat(row.find(".price").text()) || 0;
        var discountPerUnit = parseFloat(row.find(".discount").attr("data-discount-per-unit")) || 0; // Get tax per unit
        var discount = discountPerUnit * quantity;
        var taxPerUnit = parseFloat(row.find(".tax").attr("data-tax-per-unit")) || 0; // Get tax per unit
        var taxAmount = taxPerUnit * quantity; // Correct tax calculation based on quantity
        var subtotal = (price * quantity) + taxAmount - discount; // Correct subtotal calculation
        row.find(".discount").text(discount.toFixed(2)); // Update tax field
        row.find(".tax").text(taxAmount.toFixed(2)); // Update tax field
        row.find(".subtotal").text(subtotal.toFixed(2)); // Update subtotal field
        updateTotalAmount();
        console.log("----------------------------",taxPerUnit);
    });
    // Remove product row when "X" button is clicked
    $(document).on("click", ".delete-set", function () {
        $(this).closest("tr").remove();
        updateTotalAmount();
    });
    // Function to update the total amount
    function updateTotalAmount() {
        var totalSubtotal = 0;
        var totalTax = 0;
        var totalDiscount = 0;
        var saleReturnItemData = [];
        $("#saleReturnTable tr").each(function () {
            var productName = $(this).find("td:first").text();
            var quantity = parseInt($(this).find(".return-qty").val()) || 1;
            var price = parseFloat($(this).find(".price").text()) || 0;
            var discount = parseFloat($(this).find(".discount").text()) || 0;
            var tax = parseFloat($(this).find(".tax").text()) || 0;
            var subtotal = parseFloat($(this).find(".subtotal").text()) || 0;
            totalSubtotal += subtotal;
            totalTax += tax;
            totalDiscount += discount;
            saleReturnItemData.push({
                product_name: productName,
                quantity: quantity,
                price: price,
                discount: discount,
                tax: tax,
                subtotal: subtotal
            });
        });
        var totalAmount = totalSubtotal;
        // Update hidden input fields
        $("#return_total_amount").val(totalAmount.toFixed(2));
        $("#sale_return_item_data").val(JSON.stringify(saleReturnItemData));
        // Update UI
        $("input[name='sale-paid-payment']").val(totalAmount.toFixed(2));
    }
    $("#salereturnForm").submit(function (event) {
        var saleReturnItems = [];

        // Loop through each row in the table
        $("#saleReturnTable tr").each(function () {
            var productName = $(this).find("td:eq(0)").text().trim();
            var quantity = $(this).find(".return-qty").val();
            var unitPrice = parseFloat($(this).find(".price").text()) || 0;
            var discount = parseFloat($(this).find(".discount").text()) || 0;
            var tax = parseFloat($(this).find(".tax").text()) || 0;
            var subtotal = parseFloat($(this).find(".subtotal").text()) || 0;

            if (productName && quantity > 0) {
                saleReturnItems.push({
                    product_name: productName,
                    quantity: quantity,
                    unit_price: unitPrice,
                    discount: discount,
                    tax: tax,
                    subtotal: subtotal
                });
            }
        });

        // Store JSON string in the hidden input field
        $("#sale_return_item_data").val(JSON.stringify(saleReturnItems));

        // Optional: Log data before submission for debugging
        console.log("Sale Return Data:", saleReturnItems);
    });
});

$(document).ready(function () {
    $("#invoiceSelect").change(function () {
        var invoiceNumber = $(this).val();
        console.log("Invoice Number Selected:", invoiceNumber);
        if (invoiceNumber) {
            $.ajax({
                url: "purchase-return-fetch.php",
                type: "POST",
                data: { purchase_invoice: invoiceNumber },
                dataType: "json",
                success: function (response) {
                    console.log("Response from PHP:", response);
                    var dropdown = $("#purchasereturnsearch");
                    dropdown.empty().append('<option value="">Select Product</option>');
                    if (Array.isArray(response) && response.length > 0) {
                        response.forEach(function (purchase_items) {
                            console.log("Adding Product:", purchase_items.product_name);
                            dropdown.append(`<option value="${purchase_items.id}" 
                                                data-qty="${purchase_items.p_qty}" 
                                                data-price="${purchase_items.p_price}" 
                                                data-subtotal="${purchase_items.p_subtotal}" 
                                                data-discount="${purchase_items.discount}" 
                                                data-tax="${purchase_items.tax}">
                                                ${purchase_items.product_name}
                                            </option>`);
                        });
                    } else {
                        console.log("No products found in response.");
                        dropdown.append('<option value="">No products found</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        } else {
            $("#purchasereturnsearch").empty().append('<option value="">Select Product</option>');
        }
    });

    // Fetch and display product details when a product is selected
    $("#purchasereturnsearch").change(function () {
        var selectedOption = $(this).find(":selected");

        if (selectedOption.val()) {
            var productId = selectedOption.val();
            var productName = selectedOption.text().split(" - ")[0]; // Extract name
            var maxQuantity = parseInt(selectedOption.attr("data-qty")) || 1; // Maximum available quantity
            var price = parseFloat(selectedOption.attr("data-price")) || 0; // Convert to float
            var subtotal = parseFloat(selectedOption.attr("data-subtotal")) || 0;
            var discount = parseFloat(selectedOption.attr("data-discount")) || 0;
            var totalTax = parseFloat(selectedOption.attr("data-tax")) || 0;
            var taxPerUnit = totalTax / maxQuantity; // Correctly calculate tax per unit

            var deleteIconUrl = siteUrl + "assets/img/icons/delete.svg";

            var productRow = `<tr>
                                <td>${productName}</td>
                                <td><input type="number" class="form-control return-qty" style="width:100px;" min="1" max="${maxQuantity}" value="1"></td>
                                <td class="price">${price.toFixed(2)}</td>
                                <td class="discount">${discount.toFixed(2)}</td>
                                <td class="tax" data-tax-per-unit="${taxPerUnit.toFixed(2)}">${taxPerUnit.toFixed(2)}</td>
                                <td class="subtotal">${(price + taxPerUnit - discount).toFixed(2)}</td>
                                <td><a href="javascript:void(0);" class="delete-set"><img src="${deleteIconUrl}" alt="svg"></a></td>
                            </tr>`;

            $("#purchaseReturnTable").append(productRow);

            // Update Total Amount
            updateTotalAmount();
        }
    });

    // Handle quantity change and recalculate tax and subtotal
    $(document).on("input", ".return-qty", function () {
        var row = $(this).closest("tr");
        var quantity = parseInt($(this).val()) || 1;
        var maxQuantity = parseInt($(this).attr("max")) || 1;
        var price = parseFloat(row.find(".price").text()) || 0;
        var discount = parseFloat(row.find(".discount").text()) || 0;
        var taxPerUnit = parseFloat(row.find(".tax").attr("data-tax-per-unit")) || 0; // Get correct per-unit tax
        var taxAmount = taxPerUnit * quantity; // Correct tax calculation
        var subtotal = (price * quantity) + taxAmount - discount; // Correct subtotal calculation

        row.find(".tax").text(taxAmount.toFixed(2)); // Update tax field
        row.find(".subtotal").text(subtotal.toFixed(2)); // Update subtotal field

        updateTotalAmount();
    });

    // Remove product row when "X" button is clicked
    $(document).on("click", ".delete-set", function () {
        $(this).closest("tr").remove();
        updateTotalAmount();
    });

    // Function to update the total amount
    function updateTotalAmount() {
        var totalSubtotal = 0;
        var totalTax = 0;
        var totalDiscount = 0;
        var purchaseReturnItemData = [];

        $("#purchaseReturnTable tr").each(function () {
            var productName = $(this).find("td:first").text();
            var quantity = parseInt($(this).find(".return-qty").val()) || 1;
            var price = parseFloat($(this).find(".price").text()) || 0;
            var discount = parseFloat($(this).find(".discount").text()) || 0;
            var tax = parseFloat($(this).find(".tax").text()) || 0;
            var subtotal = parseFloat($(this).find(".subtotal").text()) || 0;

            totalSubtotal += subtotal;
            totalTax += tax;
            totalDiscount += discount;

            purchaseReturnItemData.push({
                product_name: productName,
                quantity: quantity,
                price: price,
                discount: discount,
                tax: tax,
                subtotal: subtotal
            });
        });

        var totalAmount = totalSubtotal;

        // Update hidden input fields
        $("#return_total_amount").val(totalAmount.toFixed(2));
        $("#purchase_return_item_data").val(JSON.stringify(purchaseReturnItemData));

        // Update UI
        $("input[name='purchase-paid-payment']").val(totalAmount.toFixed(2));
    }
    $("#purchasereturnForm").submit(function (event) {
        var purchaseReturnItems = [];

        // Loop through each row in the table
        $("#purchaseReturnTable tr").each(function () {
            var productName = $(this).find("td:eq(0)").text().trim();
            var quantity = $(this).find(".return-qty").val();
            var unitPrice = parseFloat($(this).find(".price").text()) || 0;
            var discount = parseFloat($(this).find(".discount").text()) || 0;
            var tax = parseFloat($(this).find(".tax").text()) || 0;
            var subtotal = parseFloat($(this).find(".subtotal").text()) || 0;

            if (productName && quantity > 0) {
                purchaseReturnItems.push({
                    product_name: productName,
                    quantity: quantity,
                    unit_price: unitPrice,
                    discount: discount,
                    tax: tax,
                    subtotal: subtotal
                });
            }
        });

        // Store JSON string in the hidden input field
        $("#purchase_return_item_data").val(JSON.stringify(purchaseReturnItems));

        // Optional: Log data before submission for debugging
        console.log("Purchase Return Data:", purchaseReturnItems);
    });
});
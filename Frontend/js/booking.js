function calculateTotal() {
    let catering = parseInt(document.getElementById("catering").value);
    let decoration = parseInt(document.getElementById("decoration").value);
    let card = parseInt(document.getElementById("card").value);
    let venue = parseInt(document.getElementById("venue").value);

    let total = catering + decoration + card + venue;
    document.getElementById("totalCost").innerText = "Total Cost: ₹" + total;
    document.getElementById("total").value = total; // Store total in hidden input for PHP
}
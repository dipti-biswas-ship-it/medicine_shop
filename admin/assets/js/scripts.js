document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarMenu = document.getElementById("sidebar-menu");
    const openSidebarBtn = document.getElementById("open-sidebar");
    const closeSidebarBtn = document.getElementById("close-sidebar");
    const ordersTable = document.getElementById("ordersTable");

    openSidebarBtn.addEventListener("click", function () {
        document.body.classList.toggle("sidebar-open");
    });

    closeSidebarBtn.addEventListener("click", function () {
        document.body.classList.remove("sidebar-open");
    });

    // Load Orders Data from JSON (AJAX)
    fetch('data.json')
        .then(response => response.json())
        .then(data => {
            data.forEach(order => {
                ordersTable.innerHTML += `
                    <tr>
                        <td>${order.orderNo}</td>
                        <td>${order.date}</td>
                        <td>${order.customerName}</td>
                        <td>${order.email}</td>
                        <td>$${order.price}</td>
                        <td><span class="badge bg-${order.status === 'Delivered' ? 'success' : order.status === 'Pending' ? 'warning' : 'danger'}">${order.status}</span></td>
                        <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                    </tr>
                `;
            });
        });
});
document.querySelectorAll(".nav-menu li").forEach(item => {
    item.addEventListener("click", function () {
        // Remove active class from all
        document.querySelectorAll(".nav-menu li").forEach(li => li.classList.remove("active"));
        
        // Toggle active class on clicked item
        this.classList.add("active");
    });
});


// notification click to open page
document.getElementById("openNotification").addEventListener("click", function () {
    window.location.href = "notification.html";
});


// scripts for product



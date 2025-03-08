document.addEventListener("DOMContentLoaded", function () {
    loadOrders();
});

function loadOrders() {
    fetch("api/fetch_orders.php")
        .then(response => response.json())
        .then(data => {
            let ordersList = document.getElementById("orders-list");
            ordersList.innerHTML = "";
            data.forEach(order => {
                let statusClass = order.status === "Delivered" ? "text-success" :
                                  order.status === "Pending" ? "text-warning" :
                                  "text-danger";

                ordersList.innerHTML += `
                    <tr>
                        <td>#${order.order_no}</td>
                        <td>${order.date}</td>
                        <td>${order.customer_name}</td>
                        <td>${order.email}</td>
                        <td>$${order.price}</td>
                        <td class="${statusClass}">${order.status}</td>
                        <td><button class="btn btn-sm btn-secondary">...</button></td>
                    </tr>
                `;
            });
        });
}

// scripts for product
document.addEventListener("DOMContentLoaded", function () {
    loadProducts();
});

function loadProducts() {
    fetch("api/manage-orders.php")
        .then(response => response.json())
        .then(data => {
            let productsList = document.getElementById("products-list");
            productsList.innerHTML = "";

            data.forEach(product => {
                let stockClass = product.stock === "In Stock" ? "text-success" : "text-danger";

                productsList.innerHTML += `
                    <tr>
                        <td>#${product.product_id}</td>
                        <td><img src="${product.image}" class="product-image" alt="Product"></td>
                        <td>${product.name}</td>
                        <td>${product.category}</td>
                        <td>$${product.price}</td>
                        <td class="${stockClass}">${product.stock}</td>
                        <td><button class="btn btn-sm btn-secondary">...</button></td>
                    </tr>
                `;
            });
        });
}

// scripts for customer


document.addEventListener("DOMContentLoaded", function () {
    loadUsers();
});

function loadUsers() {
    fetch("api/fetch_users.php")
        .then(response => response.json())
        .then(data => {
            let usersList = document.getElementById("users-list");
            usersList.innerHTML = "";

            data.forEach(user => {
                let statusClass = user.status === "Active" ? "text-success" :
                                  user.status === "Inactive" ? "text-warning" :
                                  "text-danger";

                usersList.innerHTML += `
                    <tr>
                        <td>#${user.user_id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.password}</td>
                        <td class="${statusClass}">${user.status}</td>
                        <td><button class="btn btn-sm btn-secondary">...</button></td>
                    </tr>
                `;
            });
        });
}



// scripts for dashboard

document.addEventListener("DOMContentLoaded", function () {
    loadDashboardData();
});

function loadDashboardData() {
    fetch("api/fetch_dashboard_data.php")
        .then(response => response.json())
        .then(data => {
            document.getElementById("total-orders").textContent = data.total_orders;
            document.getElementById("total-revenue").textContent = "$" + data.total_revenue;
            document.getElementById("pending-orders").textContent = data.pending_orders;
            document.getElementById("canceled-orders").textContent = data.canceled_orders;

            let ordersList = document.getElementById("recent-orders");
            ordersList.innerHTML = "";

            data.recent_orders.forEach(order => {
                let statusClass = order.status === "Delivered" ? "text-success" :
                                  order.status === "Pending" ? "text-warning" :
                                  "text-danger";

                ordersList.innerHTML += `
                    <tr>
                        <td>#${order.order_no}</td>
                        <td>${order.date}</td>
                        <td>${order.customer_name}</td>
                        <td>$${order.price}</td>
                        <td class="${statusClass}">${order.status}</td>
                    </tr>
                `;
            });
        });
}


// scripts for settings

document.addEventListener("DOMContentLoaded", function () {
    loadSettings();

    document.getElementById("settings-form").addEventListener("submit", function (e) {
        e.preventDefault();
        saveSettings();
    });
});

function loadSettings() {
    fetch("api/fetch_settings.php")
        .then(response => response.json())
        .then(data => {
            document.getElementById("username").value = data.username;
            document.getElementById("email").value = data.email;
            document.getElementById("notifications").value = data.notifications;
            document.getElementById("theme").value = data.theme;
        });
}

function saveSettings() {
    let settings = {
        username: document.getElementById("username").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value,
        confirmPassword: document.getElementById("confirm-password").value,
        notifications: document.getElementById("notifications").value,
        theme: document.getElementById("theme").value
    };

    fetch("api/update_settings.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(settings)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    });
}


// scripts for profile

document.addEventListener("DOMContentLoaded", function () {
    loadProfile();
});

function loadProfile() {
    fetch("api/fetch_profile.php")
        .then(response => response.json())
        .then(data => {
            document.getElementById("profile-img").src = data.image;
            document.getElementById("profile-name").innerText = data.name;
            document.getElementById("profile-email").innerText = data.email;
            document.getElementById("profile-role").innerText = data.role;
        });
}

document.getElementById("edit-profile").addEventListener("click", function () {
    alert("Edit Profile Feature Coming Soon!");
});


// scripts for notifactions

document.addEventListener("DOMContentLoaded", function () {
    loadNotifications();
});

function loadNotifications() {
    fetch("api/fetch_notifications.php")
        .then(response => response.json())
        .then(data => {
            let notificationList = document.getElementById("notifications-list");
            notificationList.innerHTML = "";

            data.forEach(notification => {
                let readClass = notification.is_read ? "" : "unread";
                
                notificationList.innerHTML += `
                    <div class="notification-card ${readClass}" id="notif-${notification.id}">
                        <div>
                            <strong>${notification.title}</strong>
                            <p>${notification.message}</p>
                            <small>${notification.date}</small>
                        </div>
                        <button class="btn btn-sm btn-secondary" onclick="markAsRead(${notification.id})">Mark Read</button>
                    </div>
                `;
            });
        });
}

function markAsRead(id) {
    fetch(`api/fetch_notifications.php?id=${id}`, { method: "POST" })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`notif-${id}`).classList.remove("unread");
            }
        });
}

function markAllRead() {
    fetch("api/fetch_notifications.php?mark_all=true", { method: "POST" })
        .then(response => response.json())
        .then(() => {
            document.querySelectorAll(".notification-card").forEach(card => {
                card.classList.remove("unread");
            });
        });
}

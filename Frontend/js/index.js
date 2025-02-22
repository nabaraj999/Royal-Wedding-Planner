document.addEventListener("DOMContentLoaded", () => {
    const username = localStorage.getItem("username") || "Guest";
    document.querySelector(".username").textContent = username;
    
    document.getElementById("login").addEventListener("click", () => {
        alert("Login functionality to be implemented");
    });
});
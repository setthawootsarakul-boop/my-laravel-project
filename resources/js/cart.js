document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popup-alert");
    const cartCount = document.getElementById("cart-count");

    function showPopup(message = "เพิ่มลงตะกร้าแล้ว!") {
        popup.textContent = message;
        popup.classList.add("show");
        setTimeout(() => popup.classList.remove("show"), 2000);
    }

    function updateCartCount(newCount) {
        if (cartCount) cartCount.textContent = newCount;
    }

    document.querySelectorAll(".add-to-cart").forEach(btn => {
        btn.addEventListener("click", async e => {
            e.preventDefault();
            const id = btn.dataset.id;
            try {
                const res = await fetch(`/cart/add/${id}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const data = await res.json();
                if (data.success) {
                    updateCartCount(data.count);
                    showPopup("เพิ่มลงตะกร้าแล้ว!");
                } else {
                    showPopup("เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง");
                }
            } catch {
                showPopup("⚠️ มีข้อผิดพลาด");
            }
        });
    });

    document.querySelectorAll(".remove-from-cart").forEach(btn => {
        btn.addEventListener("click", async e => {
            e.preventDefault();
            const id = btn.dataset.id;
            const res = await fetch(`/cart/remove/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            });
            const data = await res.json();
            if (data.success) {
                updateCartCount(data.count);
                showPopup("ลบออกจากตะกร้าแล้ว");
                location.reload();
            }
        });
    });

    document.querySelectorAll(".update-cart").forEach(btn => {
        btn.addEventListener("click", async e => {
            const id = btn.dataset.id;
            const action = btn.dataset.action;
            const res = await fetch(`/cart/update/${id}/${action}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            });
            const data = await res.json();
            if (data.success) {
                updateCartCount(data.count);
                document.getElementById(`qty-${id}`).textContent = data.quantity;
                showPopup("อัปเดตตะกร้าแล้ว");
                location.reload();
            }
        });
    });
});

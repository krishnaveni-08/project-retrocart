  window.addEventListener("DOMContentLoaded", () => {
    const btn = document.querySelector(".hero-btn");
    btn.addEventListener("mouseover", () => {
      btn.textContent = "🎮 Let’s Go!";
    });
    btn.addEventListener("mouseout", () => {
      btn.textContent = "🛒 Shop Now";
    });
  });


  document.querySelectorAll('.category-box').forEach(card => {
  card.addEventListener('click', () => {
    const title = card.querySelector('span').innerText;
    alert(`Navigating to: ${title}`);
    // Example: window.location.href = `category.html?name=${title}`;
  });
});

  document.querySelectorAll(".why-card").forEach(card => {
    card.addEventListener("click", () => {
      card.querySelector(".card-inner").classList.toggle("is-flipped");
    });
  });


  const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

menuToggle.addEventListener("click", () => {
  navLinks.classList.toggle("show");
});




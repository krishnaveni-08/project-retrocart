  <div class="container">
    <div class="align">
      <a class="button_back ghost" href="../merchant_dashboard.php"><i class="bi bi-arrow-left-circle"></i>
        Back</a>
      <div class="topbar">
        <h2 style="color:#ffd700;">RetroCart </h2>
      </div>
    </div>
    <style>
        .align{
            margin-top: 50px;
        }
    </style>


<?php
if (isset($_GET['subadmin_id'])) {
    $subadmin_id = (int) $_GET['subadmin_id'];
    $query = "SELECT * FROM sub_admins WHERE id = $subadmin_id";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);

    $subadmin_id = $row["id"];
    $manager_id = $row["manager_id"];
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $status = $row["status"];
    $created_at = $row["created_at"];
    $updated_at = $row["updated_at"];
}
?>

<h1>Edit Sub-Admin</h1>

<div class="cd">
    <form method="POST" novalidate action="./process.php" onsubmit="return validateForm()">
        <input type="hidden" name="id" value="<?= htmlspecialchars(($subadmin_id)) ?>">

        <div>
            <label for="name">Full Name</label>
            <input id="name" name="name" value="<?= htmlspecialchars(($name)) ?>" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" value="<?= htmlspecialchars(($password ?? '')) ?>" required>

            <div class="grid2" style="margin-top:10px">
                <div>
                    <label for="manager_id">Manager ID (unique)</label>
                    <input id="manager_id" name="manager_id" value="<?= htmlspecialchars(($manager_id)) ?>" required>
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" value="<?= htmlspecialchars(($phone)) ?>" required>
                </div>
            </div>

            <div class="grid2" style="margin-top:10px">
                <div>
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="active" <?= ($status == 'active') ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= ($status == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="controls">
                <button class="btn" type="submit" name="update">Save Changes</button>
            </div>
        </div>
    </form>
</div>


<!-- footer -->
<style>
  .foot{
    width:112%;
  }
  .retro-footer {
    width: 100%;

    background: #444444ff;
    color: #eee;
    text-align: center;
    padding: 40px 20px;
    border-top: 2px solid #ffd700;
    margin-top: 50px;
  }

  .retro-footer .logo {
    font-size: 1.8rem;
    color: #ffd700;
    font-weight: 700;
    margin-bottom: 5px;
    letter-spacing: 1px;
  }

  .retro-footer .tagline {
    font-size: 0.95rem;
    color: #ccc;
    margin-bottom: 20px;
  }

  .footer-links {
    list-style: none;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    padding: 0;
    margin-bottom: 20px;
  }

  .footer-links li a {
    text-decoration: none;
    color: #eee;
    font-size: 0.95rem;
    transition: color 0.3s;
  }

  .footer-links li a:hover {
    color: #ffd700;
  }

  .retro-footer .copyright {
    font-size: 0.85rem;
    color: #aaa;
    margin-top: 10px;
  }
</style>
<div class="foot">
  <!-- ====== FOOTER START ====== -->
  <footer class="retro-footer">
    <div class="footer-content">
      <h2 class="logo">RetroCart</h2>
      <p class="tagline">Reviving the golden era of the 80s & 90s.</p>

     

      <p class="copyright">
        © 2025 RetroCart. All rights reserved.
      </p>
    </div>
  </footer>
  <!-- ====== FOOTER END ====== -->

</div>
<script>
// 💡 Frontend Validation
function validateForm() {
    const name = document.getElementById("name").value.trim();
    const password = document.getElementById("password").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const managerId = document.getElementById("manager_id").value.trim();

    // Name validation (only letters and spaces)
    const namePattern = /^[A-Za-z\s]+$/;
    if (!namePattern.test(name)) {
        alert("❌ Name should only contain alphabets and spaces.");
        return false;
    }

    // Password validation — min 5 characters, at least one number and one special char
    const passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*]).{5,}$/;
    if (!passwordPattern.test(password)) {
        alert("❌ Password must have at least 5 characters, including 1 number and 1 special character.");
        return false;
    }

    // Phone validation — only digits and 9–10 length accepted
    const phonePattern = /^[0-9]{9,10}$/;
    if (!phonePattern.test(phone)) {
        alert("❌ Phone number must be 9 or 10 digits long and contain only numbers.");
        return false;
    }

    // Manager ID — cannot be empty or less than 3 chars
    if (managerId.length < 3) {
        alert("❌ Manager ID must be at least 3 characters long.");
        return false;
    }

    return true;
}
</script>

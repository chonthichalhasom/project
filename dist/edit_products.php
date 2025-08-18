<?php
require '../connect.php';

if (!isset($_GET['pro_id'])) {
    echo "<script>alert('ไม่พบรหัสสินค้า');window.location='index.php?page=products';</script>";
    exit;
}

$pro_id = intval($_GET['pro_id']);

// โหลดข้อมูลสินค้า
$sql = "SELECT * FROM products WHERE pro_id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $pro_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "<script>alert('ไม่พบข้อมูลสินค้า');window.location='index.php?page=products';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pro_name   = trim($_POST['pro_name']);
    $pro_price  = trim($_POST['pro_price']);
    $pro_amount = trim($_POST['pro_amount']);
    $pro_status = trim($_POST['pro_status']);
    $image      = $row['image']; // รูปเดิม

    if (empty($pro_name) || empty($pro_price) || empty($pro_amount) || empty($pro_status)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบ');history.back();</script>";
        exit;
    }

    // อัปโหลดรูปใหม่
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../assets/product_img/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        // ลบรูปเก่า
        if (!empty($row['image']) && file_exists($targetDir . $row['image'])) {
            unlink($targetDir . $row['image']);
        }

        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowed_types)) {
            echo "<script>alert('อนุญาตเฉพาะ JPG, JPEG, PNG, GIF');history.back();</script>";
            exit;
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $fileName;
        } else {
            echo "<script>alert('อัปโหลดรูปไม่สำเร็จ');history.back();</script>";
            exit;
        }
    }

    // อัปเดตสินค้า
    $update_sql = "UPDATE products SET pro_name=?, pro_price=?, pro_amount=?, pro_status=?, image=? WHERE pro_id=?";
    $update_stmt = $con->prepare($update_sql);
    $update_stmt->bind_param("siissi", $pro_name, $pro_price, $pro_amount, $pro_status, $image, $pro_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('แก้ไขสินค้าสำเร็จ');window.location='index.php?page=products';</script>";
    } else {
        echo "<script>alert('แก้ไขสินค้าไม่สำเร็จ');history.back();</script>";
    }
}
?>

<div class="container mt-5">
    <h3 class="mb-4">แก้ไขสินค้า</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>ชื่อสินค้า</label>
            <input type="text" name="pro_name" class="form-control" value="<?php echo htmlspecialchars($row['pro_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label>ราคา</label>
            <input type="number" name="pro_price" class="form-control" value="<?php echo htmlspecialchars($row['pro_price']); ?>" required>
        </div>
        <div class="mb-3">
            <label>จำนวน</label>
            <input type="number" name="pro_amount" class="form-control" value="<?php echo htmlspecialchars($row['pro_amount']); ?>" required>
        </div>
        <div class="mb-3">
            <label>สถานะ</label>
            <select name="pro_status" class="form-control" required>
                <option value="พร้อมขาย" <?php if($row['pro_status']=="พร้อมขาย") echo "selected"; ?>>พร้อมขาย</option>
                <option value="หมดสต๊อก" <?php if($row['pro_status']=="หมดสต๊อก") echo "selected"; ?>>หมดสต๊อก</option>
                <option value="ระงับการขาย" <?php if($row['pro_status']=="ระงับการขาย") echo "selected"; ?>>ระงับการขาย</option>
                <option value="เลิกขาย" <?php if($row['pro_status']=="เลิกขาย") echo "selected"; ?>>เลิกขาย</option>
            </select>
        </div>
        <div class="mb-3">
            <label>รูปสินค้า</label><br>
            <?php if (!empty($row['image']) && file_exists("../assets/product_img/" . $row['image'])): ?>
                <img src="../assets/product_img/<?php echo htmlspecialchars($row['image']); ?>" style="max-width:150px; margin-bottom:8px; border:1px solid #ccc; padding:3px;">
            <?php endif; ?>
            <input type="file" name="image" class="form-control mt-2">
            <small class="text-muted">เลือกไฟล์ใหม่เพื่อแทนรูปเดิม</small>
        </div>
        <button type="submit" class="btn btn-success">บันทึกการแก้ไข</button>
        <a href="index.php?page=products" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>

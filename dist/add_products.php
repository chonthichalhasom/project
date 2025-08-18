<?php
require '../connect.php';

if(isset($_POST['submit'])){
    $pro_name   = trim($_POST['pro_name']);
    $pro_price  = trim($_POST['pro_price']);
    $pro_amount = trim($_POST['pro_amount']);
    $pro_status = trim($_POST['pro_status']);
    $filename   = $_FILES['image']['name'];

    if(empty($pro_name) || empty($pro_price) || empty($pro_amount) || empty($pro_status)){
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง');history.back()</script>";
        exit;
    }

    if(!empty($filename)){
        $targetDir = "../assets/product_img/";
        if(!is_dir($targetDir)) mkdir($targetDir,0777,true);
        $filename = time() . "_" . basename($filename);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $filename);
    }

    $sql = "INSERT INTO products (pro_name, pro_price, pro_amount, pro_status, image) 
            VALUES ('$pro_name','$pro_price','$pro_amount','$pro_status','$filename')";
    $result = $con->query($sql);

    if(!$result){
        echo "<script>alert('บันทึกข้อมูลผิดพลาด');history.back()</script>";
    }else{
        echo "<script>window.location.href='index.php?page=products';</script>";
    }
}
?>

<!--begin::App Content Header-->
<div class="app-content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-0">Add Product Form</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Add Product</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
  <div class="container-fluid">
    <div class="row g-4">
      <div class="col-md-12">
        <div class="card card-primary card-outline mb-4">
          <div class="card-header">
            <div class="card-title">Add New Product</div>
          </div>
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">ชื่อสินค้า</label>
                <input type="text" name="pro_name" class="form-control" />
              </div>
              <div class="mb-3">
                <label class="form-label">ราคา</label>
                <input type="number" name="pro_price" class="form-control" min="0" />
              </div>
              <div class="mb-3">
                <label class="form-label">จำนวน</label>
                <input type="number" name="pro_amount" class="form-control" min="0" />
              </div>
              <div class="mb-3">
                <label class="form-label">สถานะ</label>
                <select name="pro_status" class="form-select">
                  <option value="">-- เลือกสถานะ --</option>
                  <option value="พร้อมขาย">พร้อมขาย</option>
                  <option value="หมดสต๊อก">หมดสต๊อก</option>
                  <option value="ระงับการขาย">ระงับการขาย</option>
                  <option value="เลิกขาย">เลิกขาย</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">รูปสินค้า</label>
                <input type="file" name="image" class="form-control" />
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
              <a href="index.php?page=products" class="btn btn-secondary">ยกเลิก</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require '../connect.php';
$sql = "SELECT * FROM products";
$result = $con->query($sql);
?>

<!--begin::App Content Header-->
<div class="app-content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-0">Products List</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Product List</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Products</h3>
          </div>
          <div class="card-body">
            <a href="index.php?page=add_products" class="btn btn-success mb-4">
              <i class="bi bi-plus-circle"></i> Add Product
            </a>
            <table class="table table-bordered text-center align-middle">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {
                  $imagePath = !empty($row['image']) ? "../assets/product_img/" . $row['image'] : "../assets/product_img/no-image.png";
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo htmlspecialchars($row['pro_name']); ?></td>
                    <td><?php echo number_format($row['pro_price'], 2); ?></td>
                    <td><?php echo $row['pro_amount']; ?></td>
                    <td><?php echo $row['pro_status']; ?></td>
                    <td>
                      <img src="<?php echo $imagePath; ?>" alt="Product Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                    </td>
                    <td>
                      <a href="index.php?page=edit_products&pro_id=<?php echo $row['pro_id']; ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <a href="index.php?page=del_product&pro_id=<?php echo $row['pro_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete this product?')">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php
                  $i++;
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
              <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end::App Content-->

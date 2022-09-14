<h2 class="py-3">Products CRUD</h2>
<p> <a href="/products/create" class="btn btn-success">Create Product</a></p>

<!-- ---------- Search bar ---------- -->
<form action="" method="get">
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Search for products" name="search" value="<?php echo $search ?>">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
  </div>
</form>
<!-- --x------- End of Search bar -------x-- -->

<!-- ---------- Start Of Table ---------- -->
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead>

      <tr>

        <th>ID</th>
        <th>Image</th>
        <th>Title</th>
        <th>Price</th>
        <th>Create Date</th>
        <th>Action</th>

      </tr>

    </thead>
    <tbody>

      <?php foreach ($products as $i => $product) : ?>
        <tr>
          <td><?php echo $i + 1; ?></td>
          <td>
            <?php if ($product['image']):?>
            <img src="/<?php echo $product['image'] ?>" class="thumb-image" alt="<?php echo $product['title'] ?>">
            <?php endif;?>
          </td>
          <td><?php echo $product['title']; ?></td>
          <td><?php echo "R " . $product['price']; ?></td>
          <td><?php echo $product['create_date']; ?></td>
          <td>
            <a href="/products/update?id=<?php echo $product['id']; ?>" class="btn btn-outline-primary">Edit</a>
            <form style="display: inline-block" action="/products/delete " method="POST">
              <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
              <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
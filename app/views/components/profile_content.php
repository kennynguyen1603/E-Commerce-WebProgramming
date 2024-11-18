<div class="profile-container">
  <aside class="sidebar">
    <ul>
      <li><a href="#">
        <i class="fa fa-slack" aria-hidden="true"></i>

      </svg> Dashboard</a></li>
      <li><a href="#">
          <i class="fa fa-user-circle" aria-hidden="true"></i>
       Account Details</a></li>
      <li><a href="#"><i class="fa fa-history" aria-hidden="true"></i>
      Order History</a></li>
      <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
      Track Order</a></li>
      <li><a href="#"> <i class="fa fa-shopping-cart"></i> Shopping Cart</a></li>
    </ul>
  </aside>
  <main class="main-content">
    <h1>Account Setting</h1>
    <section class="account-details">
      <div class="profile-section">
        <div class="profile-img">
          <img src="https://i.imgur.com/bDLhJiP.jpg" class="rounded-circle" alt="Profile Picture">
        </div>
      </div>
      <div class="profile-info">

      <form action="/e-commerce/app/server/saveprofile_handler.php" method="POST">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="Fey">
    </div>
    <div class="form-group">
        <label for="second_name">Second Name</label>
        <input type="text" id="second_name" name="second_name" value="Ibrahim">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="feyzibrahim">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="feyzibrahim@gmail.com">
    </div>
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" value="07034985827">
    </div>
    <div class="form-group">
        <label for="country">Country/Region</label>
        <select id="country" name="country">
            <option>India</option>
            <option>Viet Nam</option>
            <option>Indonesia</option>
            <option>Japanese</option>
            <option>Korea</option>
            <option>Iran</option>
            <option>Ukraine</option>
        </select>
    </div>
    <div class="form-group">
        <label for="state">State</label>
        <select id="state" name="state">
            <option>Kerala</option>
            <option>Montana</option>
            <option>Iowa</option>
            <option>Ohio</option>
            <option>New York</option>
            <option>Maine</option>
            <option>Texas</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pin">Pin Code</label>
        <input type="text" id="pin" name="pin" value="673570">
    </div>
    <button type="submit">Save Changes</button>
</form>
    </section>
  </main>
</div>

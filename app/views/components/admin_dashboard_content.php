<div class="admindashboard-container">
  <!-- Sidebar -->
  <aside class="sidebar">
    <ul>
      <li><a href="/e-commerce/app/views/admin_dashboard.php">
        <i class="fa fa-slack" aria-hidden="true"></i> Dashboard</a></li>
      <li><a href="/e-commerce/app/views/profile.php">
        <i class="fa fa-user-circle" aria-hidden="true"></i> Account Details</a></li>
      <li><a href="#"><i class="fa fa-history" aria-hidden="true"></i> Order History</a></li>
      <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Track Order</a></li>
      <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart</a></li>
    </ul>
  </aside>

  <!-- Main Dashboard -->
  <main class="dashboard">
    <header class="dashboard-header">
      <h1>Dashboard</h1>
      <p>28 Jan, 2021 - 28 Dec, 2021</p>
    </header>
    <div class="dashboard">
  <!-- Metrics Row -->
  <section class="dashboard-metrics">
    <div class="metric-box">
      <h3>Today's Sales</h3>
      <p>₹100,999</p>
    </div>
    <div class="metric-box">
      <h3>Today's Revenue</h3>
      <p>₹30,000</p>
    </div>
    <div class="metric-box">
      <h3>Users Count</h3>
      <p>20,390</p>
    </div>
  </section>

  <!-- Row for Total Revenue and Most Sold Items -->
  <section class="dashboard-row">
    <!-- Total Revenue -->
    <div class="total-revenue">
      <h3>Total Revenue</h3>
      <p>₹50,23780 <span class="growth">↑ 5% than last month</span></p>
      <div id="revenue-chart"></div>
    </div>

    <!-- Most Sold Items -->
    <div class="most-sold-items">
      <h3>Most Sold Items</h3>
      <ul>
        <li>
          <span>iPhone</span>
          <div class="progress-bar">
            <div class="progress" style="width: 70%;"></div>
          </div>
          <span>70%</span>
        </li>
        <li>
          <span>iMac</span>
          <div class="progress-bar">
            <div class="progress" style="width: 40%;"></div>
          </div>
          <span>40%</span>
        </li>
        <li>
          <span>MacBook</span>
          <div class="progress-bar">
            <div class="progress" style="width: 60%;"></div>
          </div>
          <span>60%</span>
        </li>
        <li>
          <span>Apple Watch</span>
          <div class="progress-bar">
            <div class="progress" style="width: 80%;"></div>
          </div>
          <span>80%</span>
        </li>
        <li>
          <span>AirPods</span>
          <div class="progress-bar">
            <div class="progress" style="width: 20%;"></div>
          </div>
          <span>20%</span>
        </li>
      </ul>
    </div>
  </section>
</div>


<section class="latest-orders">
  <h2>Latest Orders</h2>
  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Product</th>
        <th>Date</th>
        <th>Customer</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>302012</td>
        <td>iPhone 11 Pro</td>
        <td>29 Dec 2022</td>
        <td>Josh Wisley</td>
        <td>₹59,000</td>
        <td>24 Jun 2023</td>
        <td class="status processing">Processing</td>
        <td>
          <div class="action-buttons">
            <button class="view-btn">
              <i class="fa fa-eye" aria-hidden="true"></i> View
            </button>
            <button class="edit-btn">
              <i class="fa fa-edit" aria-hidden="true"></i> Edit
            </button>
            <button class="delete-btn">
              <i class="fa fa-trash" aria-hidden="true"></i> Delete
            </button>
          </div>
        </td>
        </td>
      </tr>
      <tr>
        <td>302013</td>
        <td>MacBook Pro</td>
        <td>30 Dec 2022</td>
        <td>Jane Doe</td>
        <td>₹1,20,000</td>
        <td>30 Jun 2023</td>
        <td class="status completed">Completed</td>
        <td>
          <div class="action-buttons">
            <button class="view-btn">
              <i class="fa fa-eye" aria-hidden="true"></i> View
            </button>
            <button class="edit-btn">
              <i class="fa fa-edit" aria-hidden="true"></i> Edit
            </button>
            <button class="delete-btn">
              <i class="fa fa-trash" aria-hidden="true"></i> Delete
            </button>
          </div>
        </td>
        </td>
      </tr>
    </tbody>
  </table>
</section>

  </main>
</div>


<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('breadcrumb', 'Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.chart-wrap{position:relative;height:280px}
.quick-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:24px}
.quick-card{background:#fff;border:1px solid var(--border);border-radius:var(--r);padding:16px;display:flex;align-items:center;gap:14px;transition:all .2s;cursor:pointer}
.quick-card:hover{transform:translateY(-2px);box-shadow:var(--shadow-md)}
.quick-icon{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
.quick-num{font-size:22px;font-weight:800;color:var(--text)}
.quick-lbl{font-size:12px;color:var(--text-muted);margin-top:2px}
.quick-change{font-size:11.5px;font-weight:600;margin-top:4px}
.quick-change.up{color:#16a34a}
.quick-change.down{color:#dc2626}
.order-status-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}
.top-product{display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid #f1f5f9}
.top-product:last-child{border-bottom:none}
.tp-rank{width:22px;height:22px;background:#f1f5f9;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:var(--text-muted);flex-shrink:0}
.tp-rank.gold{background:#fef3c7;color:#d97706}
.tp-img{width:38px;height:38px;border-radius:8px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.tp-name{font-size:13px;font-weight:500;flex:1}
.tp-sales{font-size:12px;color:var(--text-muted)}
.tp-rev{font-size:13px;font-weight:700;color:var(--green);margin-left:auto}
.activity-item{display:flex;align-items:flex-start;gap:12px;padding:10px 0;border-bottom:1px solid #f1f5f9}
.activity-item:last-child{border-bottom:none}
.activity-dot{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.activity-text{font-size:13px;color:var(--text);line-height:1.5}
.activity-time{font-size:11.5px;color:var(--text-muted);margin-top:2px}

@media(max-width:768px){
  .quick-grid{grid-template-columns:1fr 1fr}
  .two-col{grid-template-columns:1fr!important}
}
@media(max-width:480px){
  .quick-grid{grid-template-columns:1fr}
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div>
    <div class="page-title">📊 Dashboard</div>
    <div class="page-sub">Welcome back, <?php echo e(auth()->user()->name); ?>! Here's what's happening today.</div>
  </div>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.reports.sales')); ?>" class="btn btn-secondary">📈 View Reports</a>
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">+ Add Product</a>
  </div>
</div>


<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-top">
      <div class="stat-icon" style="background:#dcfce7">💰</div>
      <div class="stat-badge up">↑ 12.5%</div>
    </div>
    <div class="stat-value">₹<?php echo e(number_format($totalRevenue ?? 0)); ?></div>
    <div class="stat-label">Total Revenue</div>
    <div class="stat-foot">vs ₹<?php echo e(number_format($lastMonthRevenue ?? 0)); ?> last month</div>
  </div>

  <div class="stat-card">
    <div class="stat-top">
      <div class="stat-icon" style="background:#dbeafe">🧾</div>
      <div class="stat-badge up">↑ 8.2%</div>
    </div>
    <div class="stat-value"><?php echo e($totalOrders ?? 0); ?></div>
    <div class="stat-label">Total Orders</div>
    <div class="stat-foot"><?php echo e($todayOrders ?? 0); ?> orders today</div>
  </div>

  <div class="stat-card">
    <div class="stat-top">
      <div class="stat-icon" style="background:#fce7f3">👥</div>
      <div class="stat-badge up">↑ 5.1%</div>
    </div>
    <div class="stat-value"><?php echo e($totalCustomers ?? 0); ?></div>
    <div class="stat-label">Total Customers</div>
    <div class="stat-foot"><?php echo e($newCustomers ?? 0); ?> new this month</div>
  </div>

  <div class="stat-card">
    <div class="stat-top">
      <div class="stat-icon" style="background:#fef3c7">🛒</div>
      <div class="stat-badge down">↓ 2.3%</div>
    </div>
    <div class="stat-value"><?php echo e($totalProducts ?? 0); ?></div>
    <div class="stat-label">Total Products</div>
    <div class="stat-foot"><?php echo e($lowStockCount ?? 0); ?> low stock alerts</div>
  </div>
</div>


<div class="quick-grid">
  <a href="<?php echo e(route('admin.orders.index')); ?>?status=pending" class="quick-card">
    <div class="quick-icon" style="background:#fef9c3">⏳</div>
    <div>
      <div class="quick-num"><?php echo e($pendingOrders ?? 0); ?></div>
      <div class="quick-lbl">Pending Orders</div>
      <div class="quick-change up">Action needed</div>
    </div>
  </a>
  <a href="<?php echo e(route('admin.inventory.low')); ?>" class="quick-card">
    <div class="quick-icon" style="background:#fef2f2">⚠️</div>
    <div>
      <div class="quick-num"><?php echo e($lowStockCount ?? 0); ?></div>
      <div class="quick-lbl">Low Stock Items</div>
      <div class="quick-change down">Needs restock</div>
    </div>
  </a>
  <a href="<?php echo e(route('admin.reviews.index')); ?>?approved=0" class="quick-card">
    <div class="quick-icon" style="background:#f5f3ff">⭐</div>
    <div>
      <div class="quick-num"><?php echo e($pendingReviews ?? 0); ?></div>
      <div class="quick-lbl">Reviews Pending</div>
      <div class="quick-change up">Awaiting approval</div>
    </div>
  </a>
</div>


<div style="display:grid;grid-template-columns:1fr 360px;gap:16px;margin-bottom:24px" class="two-col">

  
  <div class="card">
    <div class="card-header">
      <div class="card-title">📈 Revenue Overview</div>
      <div style="display:flex;gap:8px">
        <select class="filter-select" style="padding:5px 10px;font-size:12px" onchange="updateChart(this.value)">
          <option value="7">Last 7 days</option>
          <option value="30" selected>Last 30 days</option>
          <option value="90">Last 3 months</option>
        </select>
      </div>
    </div>
    <div class="card-body">
      <div class="chart-wrap">
        <canvas id="revenueChart"></canvas>
      </div>
    </div>
  </div>

  
  <div class="card">
    <div class="card-header">
      <div class="card-title">🥧 Orders by Status</div>
    </div>
    <div class="card-body">
      <div style="height:200px;position:relative">
        <canvas id="statusChart"></canvas>
      </div>
      <div style="margin-top:16px;display:flex;flex-direction:column;gap:8px">
        <div style="display:flex;align-items:center;justify-content:space-between;font-size:13px">
          <div style="display:flex;align-items:center;gap:8px"><span style="width:10px;height:10px;border-radius:3px;background:#f59e0b;display:inline-block"></span>Pending</div>
          <div><strong><?php echo e($statusCounts['pending'] ?? 0); ?></strong></div>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;font-size:13px">
          <div style="display:flex;align-items:center;gap:8px"><span style="width:10px;height:10px;border-radius:3px;background:#3b82f6;display:inline-block"></span>Processing</div>
          <div><strong><?php echo e($statusCounts['processing'] ?? 0); ?></strong></div>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;font-size:13px">
          <div style="display:flex;align-items:center;gap:8px"><span style="width:10px;height:10px;border-radius:3px;background:#16a34a;display:inline-block"></span>Delivered</div>
          <div><strong><?php echo e($statusCounts['delivered'] ?? 0); ?></strong></div>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;font-size:13px">
          <div style="display:flex;align-items:center;gap:8px"><span style="width:10px;height:10px;border-radius:3px;background:#ef4444;display:inline-block"></span>Cancelled</div>
          <div><strong><?php echo e($statusCounts['cancelled'] ?? 0); ?></strong></div>
        </div>
      </div>
    </div>
  </div>
</div>


<div style="display:grid;grid-template-columns:1fr 340px;gap:16px;margin-bottom:24px" class="two-col">

  
  <div class="card">
    <div class="card-header">
      <div class="card-title">🧾 Recent Orders</div>
      <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-secondary btn-sm">View All</a>
    </div>
    <div class="table-wrap" style="border:none;border-radius:0">
      <table>
        <thead>
          <tr>
            <th>Order #</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $recentOrders ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><span style="font-weight:600;color:var(--green)">#<?php echo e($order->order_number); ?></span></td>
            <td>
              <div class="td-flex">
                <div style="width:30px;height:30px;border-radius:50%;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#16a34a;flex-shrink:0">
                  <?php echo e(substr($order->user->name ?? 'U', 0, 2)); ?>

                </div>
                <div>
                  <div style="font-size:13px;font-weight:500"><?php echo e($order->user->name ?? 'N/A'); ?></div>
                  <div style="font-size:11px;color:var(--text-muted)"><?php echo e($order->user->phone ?? ''); ?></div>
                </div>
              </div>
            </td>
            <td><strong>₹<?php echo e(number_format($order->total)); ?></strong></td>
            <td>
              <span class="badge <?php echo e($order->payment_method === 'cod' ? 'badge-secondary' : 'badge-info'); ?>">
                <?php echo e(strtoupper($order->payment_method)); ?>

              </span>
            </td>
            <td>
              <span class="badge badge-<?php echo e($order->status_badge_color); ?>">
                <?php echo e($order->status_label); ?>

              </span>
            </td>
            <td style="color:var(--text-muted);font-size:12px"><?php echo e($order->created_at->format('d M, h:i A')); ?></td>
            <td>
              <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-secondary btn-sm btn-icon" title="View">👁</a>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="7" style="text-align:center;padding:32px;color:var(--text-muted)">No orders yet</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  
  <div class="card">
    <div class="card-header">
      <div class="card-title">🏆 Top Products</div>
      <a href="<?php echo e(route('admin.reports.products')); ?>" class="btn btn-secondary btn-sm">View All</a>
    </div>
    <div class="card-body">
      <?php $__empty_1 = true; $__currentLoopData = $topProducts ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="top-product">
        <div class="tp-rank <?php echo e($i === 0 ? 'gold' : ''); ?>">#<?php echo e($i+1); ?></div>
        <div class="tp-img"><?php echo e($product->category->image ?? '🛒'); ?></div>
        <div style="flex:1;min-width:0">
          <div class="tp-name" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo e($product->name); ?></div>
          <div class="tp-sales"><?php echo e($product->order_items_count ?? 0); ?> sold</div>
        </div>
        <div class="tp-rev">₹<?php echo e(number_format($product->order_items_sum_subtotal ?? 0)); ?></div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div style="text-align:center;padding:32px;color:var(--text-muted)">No products yet</div>
      <?php endif; ?>
    </div>
  </div>
</div>


<div class="card">
  <div class="card-header">
    <div class="card-title">📋 Recent Activity</div>
  </div>
  <div class="card-body">
    <div class="activity-item">
      <div class="activity-dot" style="background:#dcfce7">✅</div>
      <div><div class="activity-text">New order <strong>#GM-2024-00042</strong> placed by Rahul Kumar — ₹450</div><div class="activity-time">2 minutes ago</div></div>
    </div>
    <div class="activity-item">
      <div class="activity-dot" style="background:#dbeafe">🚚</div>
      <div><div class="activity-text">Order <strong>#GM-2024-00039</strong> marked as Shipped</div><div class="activity-time">18 minutes ago</div></div>
    </div>
    <div class="activity-item">
      <div class="activity-dot" style="background:#fef9c3">⚠️</div>
      <div><div class="activity-text">Low stock alert — <strong>Fresh Broccoli</strong> (only 5 units left)</div><div class="activity-time">1 hour ago</div></div>
    </div>
    <div class="activity-item">
      <div class="activity-dot" style="background:#fce7f3">👤</div>
      <div><div class="activity-text">New customer registered — <strong>Priya Sharma</strong></div><div class="activity-time">2 hours ago</div></div>
    </div>
    <div class="activity-item">
      <div class="activity-dot" style="background:#f5f3ff">⭐</div>
      <div><div class="activity-text">New review on <strong>Nagpur Oranges</strong> — 5 stars</div><div class="activity-time">3 hours ago</div></div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueData = <?php echo json_encode($revenueChartData ?? ['labels'=>[], 'data'=>[]], 512) ?>;

const revenueChart = new Chart(revenueCtx, {
  type: 'line',
  data: {
    labels: revenueData.labels.length ? revenueData.labels : ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
    datasets: [{
      label: 'Revenue (₹)',
      data: revenueData.data.length ? revenueData.data : [4200,5800,4900,7100,6300,8900,7500],
      borderColor: '#16a34a',
      backgroundColor: 'rgba(22,163,74,.08)',
      borderWidth: 2.5,
      tension: 0.4,
      fill: true,
      pointBackgroundColor: '#16a34a',
      pointRadius: 4,
      pointHoverRadius: 6,
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { display: false } },
    scales: {
      y: {
        beginAtZero: true,
        grid: { color: '#f1f5f9' },
        ticks: { callback: v => '₹'+v.toLocaleString(), font: { size: 11 } }
      },
      x: {
        grid: { display: false },
        ticks: { font: { size: 11 } }
      }
    }
  }
});

// Status Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
  type: 'doughnut',
  data: {
    labels: ['Pending','Processing','Delivered','Cancelled'],
    datasets: [{
      data: [
        <?php echo e($statusCounts['pending'] ?? 12); ?>,
        <?php echo e($statusCounts['processing'] ?? 8); ?>,
        <?php echo e($statusCounts['delivered'] ?? 45); ?>,
        <?php echo e($statusCounts['cancelled'] ?? 5); ?>

      ],
      backgroundColor: ['#f59e0b','#3b82f6','#16a34a','#ef4444'],
      borderWidth: 0,
      hoverOffset: 6,
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    cutout: '70%',
    plugins: { legend: { display: false } }
  }
});

function updateChart(days) {
  // Fetch new data via AJAX
  fetch(`/admin/reports/sales?days=${days}&ajax=1`)
    .then(r => r.json())
    .then(d => {
      revenueChart.data.labels = d.labels;
      revenueChart.data.datasets[0].data = d.data;
      revenueChart.update();
    }).catch(() => {});
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>
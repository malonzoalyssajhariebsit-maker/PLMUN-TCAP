<?php
// Prepare PHP data for the donut charts
$verified = $conn->query("SELECT COUNT(*) as cnt FROM student_list WHERE status = 1")->fetch_assoc()['cnt'];
$unverified = $conn->query("SELECT COUNT(*) as cnt FROM student_list WHERE status = 0")->fetch_assoc()['cnt'];
$published = $conn->query("SELECT COUNT(*) as cnt FROM archive_list WHERE status = 1")->fetch_assoc()['cnt'];
$unpublished = $conn->query("SELECT COUNT(*) as cnt FROM archive_list WHERE status = 0")->fetch_assoc()['cnt'];
$total_users = $verified + $unverified;
$total_archives = $published + $unpublished;
$verified_pct = $total_users ? round($verified / $total_users * 100) : 0;
$unverified_pct = $total_users ? round($unverified / $total_users * 100) : 0;
$published_pct = $total_archives ? round($published / $total_archives * 100) : 0;
$unpublished_pct = $total_archives ? round($unpublished / $total_archives * 100) : 0;
?>
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box info-dept shadow">
            <span class="info-box-icon" style="background:linear-gradient(135deg, #367784 0%, #e4f7ffff 100%)"><i class="fas fa-th-list"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Department List</span>
            <span class="info-box-number text-right">
                <?php echo $conn->query("SELECT * FROM `department_list` where status = 1")->num_rows; ?>
            </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box info-curr shadow">
            <span class="info-box-icon" style="background:linear-gradient(135deg, #60b6ab 0%, #dffff9ff 100%)"><i class="fas fa-scroll"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Course List</span>
            <span class="info-box-number text-right">
                <?php echo $conn->query("SELECT * FROM `curriculum_list` where `status` = 1")->num_rows; ?>
            </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box info-vstud shadow">
            <span class="info-box-icon" style="background:linear-gradient(135deg, #85c3dfff 0%, #e9f7fbff 100%)"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Verified Students</span>
            <span class="info-box-number text-right">
                <?php echo $conn->query("SELECT * FROM `student_list` where `status` = 1")->num_rows; ?>
            </span>
            </div>
        </div>
    </div>
   
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box info-varch shadow">
            <span class="info-box-icon" style="background:linear-gradient(135deg, #a9d6ecff 0%, #dff8ffff 100%)"><i class="fas fa-archive"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Published Archives</span>
            <span class="info-box-number text-right">
                <?php echo $conn->query("SELECT * FROM `archive_list` where `status` = 1")->num_rows; ?>
            </span>
            </div>
        </div>
    </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-7 col-md-12 mb-4">
        <div class="recent-table-card">
            <div class="card-header">
                Recently Added Archives (Past 7 Days)
            </div>
            <div class="card-body p-0">
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>Date Created</th>
                            <th>Archive Code</th>
                            <th>Project Title</th>
                            <th>Course</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $recent_archives = $conn->query("SELECT a.*,c.name as curriculum FROM archive_list a LEFT JOIN curriculum_list c ON a.curriculum_id=c.id WHERE a.date_created >= DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY a.date_created DESC LIMIT 10");
                        if($recent_archives && $recent_archives->num_rows > 0):
                            while($row = $recent_archives->fetch_assoc()): ?>
                        <tr>
                            <td><?= date('Y-m-d H:i',strtotime($row['date_created'])) ?></td>
                            <td><?= $row['archive_code'] ?></td>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td><?= htmlspecialchars($row['curriculum']) ?></td>
                            <td>
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success">Published</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Unpublished</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr><td colspan="5" class="text-center text-muted">No recent archives added.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-12 mb-4">
        <div class="card pie-dark shadow" style="border-radius:18px;">
            <div class="card-header bg-gradient-dark text-white" style="border-radius:18px 18px 0 0;">
                <h5 class="m-0">Statistics Overview</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 d-flex flex-column align-items-center">
                        <canvas id="userDonutChart" width="120" height="120"></canvas>
                        <div class="mt-2 text-center">
                            <div style="font-weight:700;font-size:1rem;color:#bcecffff;margin-bottom:0.5em;font-family:'Science Gothic',sans-serif;">Student Verification<br/>Status</div>
                            <span style="display:inline-block;width:12px;height:12px;background:#0884b6ff;border-radius:3px;margin-right:4px;"></span>
                            <span style="font-weight:600;font-size:0.95rem;">Verified (<?= $verified ?>)</span><br>
                            <span style="display:inline-block;width:12px;height:12px;background:#3a4d54ff;border-radius:3px;margin-right:4px;"></span>
                            <span style="font-weight:600;font-size:0.95rem;">Unverified (<?= $unverified ?>)</span>
                        </div>
                    </div>
                    <div class="col-6 d-flex flex-column align-items-center">
                        <canvas id="archiveDonutChart" width="120" height="120"></canvas>
                        <div class="mt-2 text-center">
                             <div style="font-weight:700;font-size:1rem;color:#bcecffff;margin-bottom:0.5em;font-family:'Yellowtail',sans-serif;">Archive Publication<br/>Status</div>
                            <span style="display:inline-block;width:12px;height:12px;background:#7dc954ff;border-radius:3px;margin-right:4px;"></span>
                            <span style="font-weight:600;font-size:0.95rem;">Published (<?= $published ?>)</span><br>
                            <span style="display:inline-block;width:12px;height:12px;background:#3a4d54ff;border-radius:3px;margin-right:4px;"></span>
                            <span style="font-weight:600;font-size:0.95rem;">Unpublished (<?= $unpublished ?>)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
Chart.register(window.ChartDataLabels);
function getGradient(ctx, color1, color2) {
    const gradient = ctx.createLinearGradient(0, 0, 120, 120);
    gradient.addColorStop(0, color1);
    gradient.addColorStop(1, color2);
    return gradient;
}
const userDonutCtx = document.getElementById('userDonutChart').getContext('2d');
const userGradient = getGradient(userDonutCtx, '#abddf7ff', '#0884b6ff');
const userDonutChart = new Chart(userDonutCtx, {
    type: 'doughnut',
    data: {
        labels: ['Verified', 'Unverified'],
        datasets: [{
            data: [<?= $verified ?>, <?= $unverified ?>],
            backgroundColor: [
                userGradient, // Verified - gradient
                'rgba(40,44,60,0.7)' // Unverified - dark
            ],
            borderWidth: 0
        }]
    },
    options: {
        cutout: '65%',
        animation: {
            animateRotate: true,
            animateScale: true,
            duration: 1200,
            easing: 'easeOutQuart'
        },
        plugins: {
            legend: { display: false },
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 22 },
                display: function(context) {
                    // Only show one label in the center
                    return context.dataIndex === 0;
                },
                formatter: (value, ctx) => {
                    let total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                    let pct = total ? Math.round(value / total * 100) : 0;
                    return pct + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
const archiveDonutCtx = document.getElementById('archiveDonutChart').getContext('2d');
const archiveGradient = getGradient(archiveDonutCtx, '#83ffd4ff', '#7cc456ff');
const archiveDonutChart = new Chart(archiveDonutCtx, {
    type: 'doughnut',
    data: {
        labels: ['Published', 'Unpublished'],
        datasets: [{
            data: [<?= $published ?>, <?= $unpublished ?>],
            backgroundColor: [
                archiveGradient, // Published - gradient
                'rgba(40,44,60,0.7)' // Unpublished - dark
            ],
            borderWidth: 0
        }]
    },
    options: {
        cutout: '65%',
        animation: {
            animateRotate: true,
            animateScale: true,
            duration: 1200,
            easing: 'easeOutQuart'
        },
        plugins: {
            legend: { display: false },
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 22 },
                display: function(context) {
                    // Only show one label in the center
                    return context.dataIndex === 0;
                },
                formatter: (value, ctx) => {
                    let total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                    let pct = total ? Math.round(value / total * 100) : 0;
                    return pct + '%';
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
</script>
<style>
body, .content-wrapper, .container-fluid {
background: 
    radial-gradient(circle at 20% 20%, rgba(30, 37, 47, 1), transparent 60%),
    radial-gradient(circle at 80% 30%, rgba(47, 56, 56, 0.45), transparent 60%),
    radial-gradient(circle at 50% 70%, rgba(80, 214, 255, 0.45), transparent 60%),
    radial-gradient(circle at 30% 80%, rgba(24, 12, 62, 0.45), transparent 60%),
    #171720ff !important;
}
.info-box {
    color: #ffffffff;
    border-radius: 18px;
    box-shadow: 0 8px 32px rgba(34, 42, 35, 0.18);
    margin-bottom: 2rem;
}
.info-box:hover {
    filter: brightness(1.12) drop-shadow(0 0 12px #9bffe488);
    box-shadow: 0 12px 32px 0 rgba(80, 255, 255, 0.18), 0 4px 16px 0 rgba(0,0,0,0.25);
    transition: filter 0.2s, box-shadow 0.2s;
}
.info-dept {
    background: linear-gradient(90deg, #15373a93, #213536b0) !important;
}
.info-dept:hover {
    background: linear-gradient(90deg, #355c7179, #1d292eff) !important;
}
.info-curr {
    background: linear-gradient(90deg, #15373a93, #213536b0) !important;
}
.info-curr:hover {
background: linear-gradient(90deg, #355c7179, #1d292eff) !important;}
.info-vstud {
     background: linear-gradient(90deg, #15373a93, #213536b0) !important;
}
.info-vstud:hover {
background: linear-gradient(90deg, #355c7179, #1d292eff) !important;}
.info-nvstud {
      background: linear-gradient(90deg, #15373a93, #213536b0) !important;
}
.info-nvstud:hover {
     background: linear-gradient(90deg, #355c7179, #1d292eff) !important;}
.info-varch {
   background: linear-gradient(90deg, #15373a93, #213536b0) !important;
}
.info-varch:hover {
    background: linear-gradient(90deg, #355c7179, #1d292eff) !important;
}
.info-nvarch {
    background: linear-gradient(90deg, #15373a93, #213536b0) !important;
}
.info-nvarch:hover {
    background: linear-gradient(90deg, #355c7179, #1d292eff) !important;
}
.info-box-icon {
    width: 60px !important;
    height: 60px !important;
    border-radius: 100% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 2rem !important;
    color: #505153ff !important;
    box-shadow: 0 4px 16px rgba(52, 111, 60, 0.53) !important;
}
.info-box-content {
    color: #ffffffff;
}
.info-box-text {
    font-weight: 700;
    font-size: 1.1rem;
    color: #ffffffff;
    font-family: "Science Gothic", sans-serif;
}
.info-box-number {
    font-size: 2rem;
    font-weight: 800;
    color: #c2c3c7ff;
}
.recent-table-card {
    background: #181923ff !important;
    border-radius: 14px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.18);
    padding: 0.5rem 0.5rem 1.5rem 0.5rem;
}
.recent-table-card .card-header {
    background: transparent !important;
    border-bottom: none;
    color: #fff;
    font-size: 1.2rem;
    font-weight: 700;
    padding-bottom: 0.5rem;
}
.recent-table {
    width: 100%;
    border-radius: 10px;
    overflow: hidden;
    background: #8393adff !important;
}
.recent-table thead th {
    background: #232733 !important;
    color: #fff !important;
    border: none;
    font-weight: 600;
    font-size: 1rem;
    padding: 0.75rem;
}
.recent-table tbody tr {
    background: #181c23 !important;

    color: #eaeaea !important;
    border-bottom: 1px solid #282a2dff;
}
.recent-table tbody tr:last-child {
    border-bottom: none;
}
.recent-table td {
    padding: 0.7rem 0.5rem;
    font-size: 0.98rem;
    vertical-align: middle;
    border: none;
}
.recent-table .badge-success {
    background: #2ecc71 !important;
    color: #fff !important;
    border-radius: 12px;
    font-size: 0.95rem;
    padding: 0.35em 1em;
}
.recent-table .badge-secondary {
    background: #4a545eff !important;
    color: #fff !important;
    border-radius: 12px;
    font-size: 0.95rem;
    padding: 0.35em 1em;
}
.card-header.bg-gradient-dark {
    background: #232733 !important;
    color: #fff !important;
    border-radius: 14px 14px 0 0 !important;
}
.card.pie-dark, .pie-dark .card-body {
    background: #181c23 !important;
    color: #fff !important;
    border-radius: 14px !important;
}
.pie-dark .card-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.pie-dark .mt-2 span {
    color: #fff !important;
}
</style>




<!---------------

<div class="">
    <div>
        <div class="" style="height: 100vh;">
            <iframe 
                src="http://localhost:5000/" 
                style="width:100%; height:100%; background:#181c23; border: none;"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

<style>
     body, .content-wrapper {
        background: #121a29ff !important
    }


</style>

-----
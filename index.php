<?php
/**
 * TWUBAKE NEZA - Public Information Portal with Database
 */
include 'includes/auth.php';

// Get public projects from database
$stmt = $project->readAll('visitor');
$publicProjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get statistics for public display
$stats = $project->getStatistics();

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h2>E-Construction Project Monitoring System</h2>
        <p>Transparent tracking of community and government-funded construction projects in Huye District</p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-top: 2rem;">
            <div style="text-align: center;">
                <div style="font-size: 2rem; font-weight: bold; color: var(--dark-slate-gray);"><?php echo $stats['total_projects'] ?? 0; ?></div>
                <div style="color: var(--dim-gray);">Total Projects</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2rem; font-weight: bold; color: var(--dark-slate-gray);"><?php echo $stats['completed_projects'] ?? 0; ?></div>
                <div style="color: var(--dim-gray);">Completed</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2rem; font-weight: bold; color: var(--dark-slate-gray);">RWF <?php echo isset($stats['total_budget']) ? number_format($stats['total_budget'] / 1000000, 1) : 0; ?>M</div>
                <div style="color: var(--dim-gray);">Total Investment</div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section">
    <div class="container">
        <h2 class="section-title">About TWUBAKE NEZA</h2>
        <div class="card">
            <h3>Program Overview</h3>
            <p>TWUBAKE NEZA is a digital initiative by Huye District to enhance accountability and transparency in infrastructure development. Our system monitors and evaluates community and government-funded construction projects including classrooms, bridges, health centers, and roads.</p>
            
            <h3>Objectives</h3>
            <ul>
                <li>Ensure transparent use of construction funds</li>
                <li>Provide real-time project progress tracking</li>
                <li>Enable community participation and oversight</li>
                <li>Improve project delivery timelines</li>
                <li>Enhance accountability among stakeholders</li>
            </ul>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="section" style="background-color: var(--platinum);">
    <div class="container">
        <h2 class="section-title">Featured Projects</h2>
        <?php if (count($publicProjects) > 0): ?>
            <div class="card-grid">
                <?php foreach ($publicProjects as $project_item): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($project_item['name']); ?></h3>
                    <p><strong>Type:</strong> <?php echo ucfirst(str_replace('_', ' ', $project_item['type'])); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($project_item['location']); ?></p>
                    <p><strong>Sector:</strong> <?php echo htmlspecialchars($project_item['sector']); ?></p>
                    <p><strong>Progress:</strong> 
                        <span class="status-<?php echo $project_item['status'] == 'completed' ? 'completed' : 'in-progress'; ?>">
                            <?php echo $project_item['current_progress']; ?>%
                        </span>
                    </p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $project_item['current_progress']; ?>%"></div>
                    </div>
                    <div style="margin-top: 1rem;">
                        <a href="project_view.php?id=<?php echo $project_item['id']; ?>" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 2rem;">
                <p>No public projects available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Guide Section -->
<section id="guide" class="section">
    <div class="container">
        <h2 class="section-title">How Projects Are Managed</h2>
        <div class="card-grid">
            <div class="card">
                <h3>1. Project Registration</h3>
                <p>Authorized engineers register new construction projects with detailed information including budget, timeline, and specifications.</p>
            </div>
            <div class="card">
                <h3>2. Progress Tracking</h3>
                <p>Site engineers regularly update project progress, completion percentage, and document any challenges encountered.</p>
            </div>
            <div class="card">
                <h3>3. Quality Assurance</h3>
                <p>District administrators review projects, ensure compliance with standards, and approve projects for public viewing.</p>
            </div>
            <div class="card">
                <h3>4. Public Reporting</h3>
                <p>Completed projects and progress updates are made available to the public through this portal.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
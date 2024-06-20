<?php if (isset($projects) && $projects): ?>
    <?php while ($row = $projects->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="project">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p><?= htmlspecialchars($row['description']) ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No projects found.</p>
<?php endif; ?>

<div class="container mt-4">
    <h2 class="mb-4">Projects</h2>
    <?php if (isset($projects) && $projects): ?>
        <div class="row">
            <?php while ($row = $projects->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-md-4">
                    <div class="project card">
                        <div class="card-body">
                            <h3 class="card-title"><?= htmlspecialchars($row['title']) ?></h3>
                            <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="no-projects">No projects found.</p>
    <?php endif; ?>
</div>

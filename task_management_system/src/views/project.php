<?php if (isset($tasks) && $tasks): ?>
    <?php while ($row = $tasks->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="task">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p><?= htmlspecialchars($row['description']) ?></p>
            <p>Status: <?= htmlspecialchars($row['status']) ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No tasks found for this project.</p>
<?php endif; ?>

<div class="container mt-4">
    <h2 class="mb-4">Project Details</h2>
    <div class="project-details">
        <h3><?= htmlspecialchars($projectData['title']) ?></h3>
        <p><?= htmlspecialchars($projectData['description']) ?></p>
    </div>
    <h3 class="mt-4">Tasks</h3>
    <?php if (isset($tasks) && $tasks): ?>
        <div class="list-group">
            <?php while ($row = $tasks->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="task list-group-item">
                    <h4 class="mb-1"><?= htmlspecialchars($row['title']) ?></h4>
                    <p class="mb-1"><?= htmlspecialchars($row['description']) ?></p>
                    <small>Status: <?= htmlspecialchars($row['status']) ?></small>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="no-tasks">No tasks found for this project.</p>
    <?php endif; ?>
</div>

<?php
// Load JSON data
function load_json($path) {
    if (!file_exists($path)) return null;
    $json = file_get_contents($path);
    return json_decode($json, true);
}

// Load patient and immunization data
$patient = load_json(__DIR__ . '/data/patient.json');
$imms = load_json(__DIR__ . '/data/immunizations.json');

// Set page title
$page_title = "myHealth Summary";
?>

<?php include 'includes/header.php'; ?>

<main class="dashboard">
    <div class="container">
        <div class="dashboard-header">
            <h1>myHealth Summary</h1>
            <?php if ($patient): ?>
                <p class="patient-info">
                    <?php echo htmlspecialchars($patient['name']); ?> • 
                    Born <?php echo date('M j, Y', strtotime($patient['dob'])); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="card-grid">
            <!-- Medications Card -->
            <section class="card medications-card">
                <div class="card-header">
                    <h2>Medications</h2>
                    <div class="card-icon medications-icon"></div>
                </div>
                <div class="card-content">
                    <?php if ($patient && !empty($patient['medications'])): ?>
                        <?php foreach ($patient['medications'] as $med): ?>
                            <div class="med-item">
                                <h3><?php echo htmlspecialchars($med['name']); ?></h3>
                                <p><?php echo htmlspecialchars($med['dose']); ?>, <?php echo htmlspecialchars($med['frequency']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-state">No medications recorded</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Allergies Card -->
            <section class="card allergies-card">
                <div class="card-header">
                    <h2>Allergies</h2>
                    <div class="card-icon allergies-icon"></div>
                </div>
                <div class="card-content">
                    <?php if ($patient && !empty($patient['allergies'])): ?>
                        <?php foreach ($patient['allergies'] as $allergy): ?>
                            <div class="allergy-item">
                                <h3><?php echo htmlspecialchars($allergy['substance']); ?></h3>
                                <p>Reaction: <?php echo htmlspecialchars($allergy['reaction']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-state">No known allergies</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Diagnoses Card -->
            <section class="card problems-card">
                <div class="card-header">
                    <h2>Active Problems</h2>
                    <div class="card-icon problems-icon"></div>
                </div>
                <div class="card-content">
                    <?php if ($patient && !empty($patient['problems'])): ?>
                        <?php foreach ($patient['problems'] as $problem): ?>
                            <div class="problem-item">
                                <h3><?php echo htmlspecialchars($problem['display']); ?></h3>
                                <p class="problem-code">Code: <?php echo htmlspecialchars($problem['code']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-state">No active problems</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <!-- Immunizations Section (Integration) -->
        <section class="immunizations-section">
            <div class="card immunizations-card highlighted">
                <div class="card-header">
                    <h2>Immunization History</h2>
                    <div class="card-icon immunizations-icon"></div>
                </div>
                <div class="integration-label">
                    <span class="source-badge">Data Source: National Clinical Data Repository</span>
                </div>
                <div class="card-content">
                    <?php if ($imms && !empty($imms['immunizations'])): ?>
                        <div class="immunizations-table">
                            <?php foreach ($imms['immunizations'] as $imm): ?>
                                <div class="imm-row">
                                    <div class="imm-vaccine">
                                        <h3><?php echo htmlspecialchars($imm['vaccine']); ?></h3>
                                        <span class="imm-status status-<?php echo $imm['status']; ?>">
                                            <?php echo ucfirst($imm['status']); ?>
                                        </span>
                                    </div>
                                    <div class="imm-details">
                                        <p class="imm-date"><?php echo date('M j, Y', strtotime($imm['date'])); ?></p>
                                        <p class="imm-lot">Lot: <?php echo htmlspecialchars($imm['lot']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p class="data-timestamp">
                            Last updated: <?php echo date('M j, Y g:i A', strtotime($imms['retrieved_at'])); ?>
                        </p>
                    <?php else: ?>
                        <p class="empty-state">No immunization records available</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Create New Client</h4>
        <p class="text-secondary small mb-0">Add a new organization to the system</p>
    </div>
    <a href="/clients" class="btn btn-outline-secondary btn-sm px-3">
        <i class="bi bi-arrow-left me-1"></i> Back to List
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="/clients/store" method="POST">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label small fw-medium">Organization Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. BioTech Corp" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="contact@company.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-medium">Phone Number</label>
                            <input type="text" name="phone" class="form-control form-control-sm" placeholder="+1 (555) 000-0000">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-medium">Location</label>
                            <input type="text" name="location" class="form-control form-control-sm" placeholder="City, State">
                        </div>
                        <div class="col-md-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-save me-1"></i> Save Client
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
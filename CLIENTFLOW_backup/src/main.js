import { db } from './data.js';

/**
 * Common Utils
 */
export function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(amount);
}

export function getStatusBadgeClass(status) {
    const s = status.toLowerCase();
    if (s.includes('active')) return 'badge-active';
    if (s.includes('pending') || s.includes('hold')) return 'badge-pending';
    if (s.includes('completed')) return 'badge-completed';
    return 'badge-danger';
}

/**
 * Dashboard Renderer
 */
export function renderDashboard() {
    const stats = db.getStats();
    
    // Update stats cards
    const statsContainer = document.querySelector('.row.g-4.mb-5');
    if (statsContainer) {
        statsContainer.innerHTML = `
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-icon"><i class="bi bi-people"></i></div>
                    <span class="stats-label">Total Clients</span>
                    <h3 class="stats-value">${stats.totalClients}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-icon"><i class="bi bi-briefcase"></i></div>
                    <span class="stats-label">Active Projects</span>
                    <h3 class="stats-value">${stats.activeProjects}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-icon"><i class="bi bi-cash-stack"></i></div>
                    <span class="stats-label">Paid Invoices</span>
                    <h3 class="stats-value">${formatCurrency(stats.totalPaid)}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-icon"><i class="bi bi-clock-history"></i></div>
                    <span class="stats-label">Pending Amount</span>
                    <h3 class="stats-value">${formatCurrency(stats.pendingAmount)}</h3>
                </div>
            </div>
        `;
    }
}

/**
 * Projects Renderer
 */
export function renderProjects() {
    const projects = db.getProjects();
    const tableBody = document.querySelector('.table tbody');
    
    if (tableBody) {
        tableBody.innerHTML = projects.map(p => `
            <tr>
                <td>
                    <div class="fw-semibold">${p.name}</div>
                    <div class="text-muted smaller" style="font-size: 11px;">${p.category || 'General'}</div>
                </td>
                <td>${p.client}</td>
                <td><span class="badge ${getStatusBadgeClass(p.status)}">${p.status}</span></td>
                <td>${new Date(p.deadline).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</td>
                <td>${formatCurrency(p.budget)}</td>
                <td class="text-end">
                    <button class="btn btn-sm text-muted"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm text-muted"><i class="bi bi-three-dots"></i></button>
                </td>
            </tr>
        `).join('');
    }
}

/**
 * Clients Renderer
 */
export function renderClients() {
    const clients = db.getClients();
    const clientsGrid = document.querySelector('.row.g-4');
    
    if (clientsGrid && document.title.includes('Clients')) {
        clientsGrid.innerHTML = clients.map(c => {
            const paidPercent = (c.paid / c.billed) * 100;
            const due = c.billed - c.paid;
            
            return `
                <div class="col-md-6 col-lg-4">
                    <div class="card finance-card">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h4 class="h5 mb-1">${c.name}</h4>
                                <p class="text-muted smaller mb-0">${c.email}</p>
                            </div>
                            <span class="badge ${getStatusBadgeClass(c.status)}">${c.status}</span>
                        </div>
                        
                        <div class="amount-row">
                            <span class="amount-label">Total Billed</span>
                            <span class="amount-value">${formatCurrency(c.billed)}</span>
                        </div>
                        
                        <div class="progress">
                            <div class="progress-bar" style="width: ${paidPercent}%; ${paidPercent === 100 ? 'background-color: var(--success);' : ''}"></div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="amount-label">Paid</div>
                                <div class="amount-value text-success">${formatCurrency(c.paid)}</div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="amount-label">Due</div>
                                <div class="amount-value ${due > 0 ? 'text-danger' : ''}">${formatCurrency(due)}</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }
}

// Global initialization
document.addEventListener('DOMContentLoaded', () => {
    const title = document.title.toLowerCase();
    if (title.includes('dashboard')) renderDashboard();
    if (title.includes('projects')) {
        renderProjects();
        setupProjectForm();
    }
    if (title.includes('clients')) renderClients();
});

function setupProjectForm() {
    const form = document.querySelector('#addProjectModal form');
    const saveBtn = document.querySelector('#addProjectModal .btn-primary');
    
    if (saveBtn && form) {
        saveBtn.addEventListener('click', () => {
            const formData = new FormData(form);
            const name = form.querySelector('input[placeholder="Enter project name"]').value;
            const client = form.querySelector('select').value;
            const budget = parseFloat(form.querySelector('input[placeholder="$0.00"]').value.replace('$', '')) || 0;
            const deadline = form.querySelector('input[type="date"]').value;

            if (name && client) {
                db.addProject({
                    name,
                    client,
                    budget,
                    deadline,
                    status: 'Active'
                });
                
                // Refresh and close
                renderProjects();
                const modal = bootstrap.Modal.getInstance(document.getElementById('addProjectModal'));
                modal.hide();
                form.reset();
            }
        });
    }
}

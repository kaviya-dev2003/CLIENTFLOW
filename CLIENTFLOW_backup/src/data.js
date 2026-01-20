/**
 * CLIENTFLOW State Management
 * Handles Projects, Clients, and Finance data
 */

const INITIAL_DATA = {
    projects: [
        { id: 1, name: 'E-commerce Redesign', client: 'Acme Corp', status: 'Active', deadline: '2024-10-24', budget: 12500, category: 'Design & Dev' },
        { id: 2, name: 'Mobile App Branding', client: 'Global Tech', status: 'Pending', deadline: '2024-11-12', budget: 4200, category: 'Design' },
        { id: 3, name: 'SaaS Platform Dev', client: 'Nexus Systems', status: 'Completed', deadline: '2024-09-30', budget: 25000, category: 'Development' }
    ],
    clients: [
        { id: 1, name: 'Acme Corp', email: 'tech-solutions@acme.com', status: 'Active', billed: 42000, paid: 31500 },
        { id: 2, name: 'Global Tech', email: 'info@globaltech.com', status: 'Active', billed: 18500, paid: 18500 },
        { id: 3, name: 'Nexus Systems', email: 'billing@nexus.io', status: 'On Hold', billed: 5000, paid: 1000 }
    ],
    currentUser: {
        name: 'Alex Rivers',
        role: 'Admin',
        avatar: 'AR'
    }
};

class ClientFlowData {
    constructor() {
        this.data = JSON.parse(localStorage.getItem('clientflow_db')) || INITIAL_DATA;
    }

    save() {
        localStorage.setItem('clientflow_db', JSON.stringify(this.data));
    }

    // Projects
    getProjects() { return this.data.projects; }
    addProject(project) {
        const newProject = {
            id: Date.now(),
            ...project,
            status: project.status || 'Active'
        };
        this.data.projects.push(newProject);
        this.save();
        return newProject;
    }

    // Clients
    getClients() { return this.data.clients; }
    
    // Stats
    getStats() {
        const projects = this.data.projects;
        const clients = this.data.clients;
        
        const totalBilled = clients.reduce((sum, c) => sum + c.billed, 0);
        const totalPaid = clients.reduce((sum, c) => sum + c.paid, 0);
        
        return {
            totalClients: clients.length,
            activeProjects: projects.filter(p => p.status === 'Active').length,
            totalPaid: totalPaid,
            pendingAmount: totalBilled - totalPaid,
            tasksDue: 8 // Mocked for now
        };
    }
}

export const db = new ClientFlowData();

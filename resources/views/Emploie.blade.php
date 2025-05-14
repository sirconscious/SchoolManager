<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du Temps - SchoolManager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-50 dark:bg-gray-900 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        <i class="fas fa-calendar-alt text-blue-600 mr-3"></i>
                        Emploi du Temps
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Gérez les horaires hebdomadaires</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3">
                    <button onclick="saveSchedule()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-save"></i>
                        <span>Sauvegarder</span>
                    </button>
                    <button onclick="clearSchedule()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-trash"></i>
                        <span>Vider</span>
                    </button>
                    <button onclick="exportPDF()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-file-pdf"></i>
                        <span>PDF</span>
                    </button>
                    <button onclick="printSchedule()" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-print"></i>
                        <span>Imprimer</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Schedule Table Container -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                    Semaine du <span id="current-week" class="text-blue-600"></span>
                </h2>

                <!-- Schedule Table -->
                <div class="overflow-x-auto">
                    <table id="schedule-table" class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <th class="p-4 text-left text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600 rounded-tl-lg">
                                    Horaires
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                    Lundi
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                    Mardi
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                    Mercredi
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                    Jeudi
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600">
                                    Vendredi
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600 rounded-tr-lg">
                                    Samedi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Generate time slots -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Subject Color Legend -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Légende des couleurs</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-blue-500 rounded"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Mathématiques</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-green-500 rounded"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Sciences</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-yellow-500 rounded"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Français</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-purple-500 rounded"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Histoire</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-red-500 rounded"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Anglais</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-indigo-500 rounded"></div>
                    <span class="text-sm text-gray-700 dark:text-gray-300">Sport</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Modifier le créneau</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="edit-form" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Matière</label>
                        <input type="text" id="subject-input" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="Ex: Mathématiques">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Salle</label>
                        <input type="text" id="classroom-input" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="Ex: A101">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Professeur</label>
                        <input type="text" id="teacher-input" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" placeholder="Ex: M. Dupont">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Couleur</label>
                        <select id="color-select" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="blue">Bleu (Mathématiques)</option>
                            <option value="green">Vert (Sciences)</option>
                            <option value="yellow">Jaune (Français)</option>
                            <option value="purple">Violet (Histoire)</option>
                            <option value="red">Rouge (Anglais)</option>
                            <option value="indigo">Indigo (Sport)</option>
                            <option value="gray">Gris (Autres)</option>
                        </select>
                    </div>

                    <div class="flex space-x-3 pt-4">
                        <button type="button" onclick="saveCell()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition duration-200">
                            Sauvegarder
                        </button>
                        <button type="button" onclick="clearCell()" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-200">
                            Vider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Time slots from 8:00 to 17:00
    const timeSlots = [
        '08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00',
        '12:00 - 13:00', '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00', '16:00 - 17:00'
    ];

    const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    const colorClasses = {
        blue: 'bg-blue-100 border-blue-300 text-blue-800 dark:bg-blue-800 dark:border-blue-600 dark:text-blue-100',
        green: 'bg-green-100 border-green-300 text-green-800 dark:bg-green-800 dark:border-green-600 dark:text-green-100',
        yellow: 'bg-yellow-100 border-yellow-300 text-yellow-800 dark:bg-yellow-800 dark:border-yellow-600 dark:text-yellow-100',
        purple: 'bg-purple-100 border-purple-300 text-purple-800 dark:bg-purple-800 dark:border-purple-600 dark:text-purple-100',
        red: 'bg-red-100 border-red-300 text-red-800 dark:bg-red-800 dark:border-red-600 dark:text-red-100',
        indigo: 'bg-indigo-100 border-indigo-300 text-indigo-800 dark:bg-indigo-800 dark:border-indigo-600 dark:text-indigo-100',
        gray: 'bg-gray-100 border-gray-300 text-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100'
    };

    let currentCell = null;
    let scheduleData = {};

    // Initialize the schedule
    document.addEventListener('DOMContentLoaded', function() {
        generateScheduleTable();
        updateCurrentWeek();
    });

    function generateScheduleTable() {
        const tbody = document.querySelector('#schedule-table tbody');
        tbody.innerHTML = '';

        timeSlots.forEach(time => {
            const row = document.createElement('tr');
            
            // Time slot cell
            const timeCell = document.createElement('td');
            timeCell.className = 'p-3 bg-gray-50 dark:bg-gray-700 text-sm font-medium text-gray-900 dark:text-white border border-gray-200 dark:border-gray-600';
            timeCell.textContent = time;
            row.appendChild(timeCell);

            // Day cells
            days.forEach((day, dayIndex) => {
                const cell = document.createElement('td');
                cell.className = 'p-2 border border-gray-200 dark:border-gray-600 h-20 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150';
                cell.onclick = () => openEditModal(time, dayIndex, cell);
                
                // Add data attributes for identification
                cell.dataset.time = time;
                cell.dataset.day = day;
                cell.dataset.dayIndex = dayIndex;
                
                row.appendChild(cell);
            });
            
            tbody.appendChild(row);
        });
    }

    function openEditModal(time, dayIndex, cell) {
        currentCell = cell;
        const modal = document.getElementById('edit-modal');
        
        // Get existing data from cell
        const cellData = getCellData(cell);
        
        document.getElementById('subject-input').value = cellData.subject || '';
        document.getElementById('classroom-input').value = cellData.classroom || '';
        document.getElementById('teacher-input').value = cellData.teacher || '';
        document.getElementById('color-select').value = cellData.color || 'blue';
        
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('edit-modal').classList.add('hidden');
        currentCell = null;
    }

    function getCellData(cell) {
        return {
            subject: cell.dataset.subject || '',
            classroom: cell.dataset.classroom || '',
            teacher: cell.dataset.teacher || '',
            color: cell.dataset.color || 'blue'
        };
    }

    function saveCell() {
        if (!currentCell) return;
        
        const subject = document.getElementById('subject-input').value;
        const classroom = document.getElementById('classroom-input').value;
        const teacher = document.getElementById('teacher-input').value;
        const color = document.getElementById('color-select').value;
        
        // Update cell data
        currentCell.dataset.subject = subject;
        currentCell.dataset.classroom = classroom;
        currentCell.dataset.teacher = teacher;
        currentCell.dataset.color = color;
        
        // Update cell appearance
        updateCellDisplay(currentCell, { subject, classroom, teacher, color });
        
        closeModal();
    }

    function clearCell() {
        if (!currentCell) return;
        
        currentCell.dataset.subject = '';
        currentCell.dataset.classroom = '';
        currentCell.dataset.teacher = '';
        currentCell.dataset.color = 'blue';
        
        updateCellDisplay(currentCell, { subject: '', classroom: '', teacher: '', color: 'blue' });
        
        closeModal();
    }

    function updateCellDisplay(cell, data) {
        // Clear existing classes
        cell.className = 'p-2 border border-gray-200 dark:border-gray-600 h-20 cursor-pointer transition duration-150';
        
        if (data.subject) {
            // Add color classes
            cell.className += ' ' + colorClasses[data.color];
            
            // Create content
            cell.innerHTML = `
                <div class="text-xs font-semibold mb-1">${data.subject}</div>
                <div class="text-xs opacity-75">${data.classroom}</div>
                <div class="text-xs opacity-75">${data.teacher}</div>
            `;
        } else {
            cell.innerHTML = '';
            cell.className += ' hover:bg-gray-50 dark:hover:bg-gray-700';
        }
    }

    function saveSchedule() {
        // Collect all schedule data
        const tableData = {};
        const cells = document.querySelectorAll('#schedule-table tbody td[data-time]');
        
        cells.forEach(cell => {
            const time = cell.dataset.time;
            const day = cell.dataset.day;
            const data = getCellData(cell);
            
            if (!tableData[time]) tableData[time] = {};
            tableData[time][day] = data;
        });
        
        // Here you would typically send this data to your backend
        console.log('Saving schedule:', tableData);
        
        // Show success message
        showNotification('Emploi du temps sauvegardé avec succès!', 'success');
    }

    function clearSchedule() {
        if (confirm('Êtes-vous sûr de vouloir vider tout l\'emploi du temps?')) {
            const cells = document.querySelectorAll('#schedule-table tbody td[data-time]');
            cells.forEach(cell => {
                updateCellDisplay(cell, { subject: '', classroom: '', teacher: '', color: 'blue' });
                cell.dataset.subject = '';
                cell.dataset.classroom = '';
                cell.dataset.teacher = '';
                cell.dataset.color = 'blue';
            });
            
            showNotification('Emploi du temps vidé avec succès!', 'success');
        }
    }

    function exportPDF() {
        // This would typically generate and download a PDF
        showNotification('Export PDF en cours...', 'info');
        // Implement PDF generation here
    }

    function printSchedule() {
        window.print();
    }

    function updateCurrentWeek() {
        const now = new Date();
        const startOfWeek = new Date(now.setDate(now.getDate() - now.getDay() + 1));
        const endOfWeek = new Date(now.setDate(startOfWeek.getDate() + 5));
        
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        const weekText = `${startOfWeek.toLocaleDateString('fr-FR', options)} - ${endOfWeek.toLocaleDateString('fr-FR', options)}`;
        
        document.getElementById('current-week').textContent = weekText;
    }

    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            info: 'bg-blue-500'
        };
        
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Slide in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Close modal on outside click
    document.getElementById('edit-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    </script>
</body>
</html>

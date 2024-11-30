// Confirmation for actions
function confirmAction(message) {
    return confirm(message);
}

// Edit Modal - Open and Pre-fill Data
function openEditModal(id, title, author) {
    const modal = document.getElementById('editModal');
    const overlay = document.getElementById('modalOverlay');
    document.getElementById('editBookId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editAuthor').value = author;
    modal.style.display = 'block';
    overlay.style.display = 'block';
}

// Close Edit Modal
function closeEditModal() {
    const modal = document.getElementById('editModal');
    const overlay = document.getElementById('modalOverlay');
    modal.style.display = 'none';
    overlay.style.display = 'none';
}

// Attach confirmation to delete buttons
document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('button.delete');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            if (!confirmAction('Are you sure you want to delete this book?')) {
                event.preventDefault();
            }
        });
    });

    const borrowButtons = document.querySelectorAll('button.borrow');
    borrowButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            if (!confirmAction('Are you sure you want to borrow this book?')) {
                event.preventDefault();
            }
        });
    });

    const returnButtons = document.querySelectorAll('button.return');
    returnButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            if (!confirmAction('Are you sure you want to return this book?')) {
                event.preventDefault();
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category');
    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            const categoryFields = document.querySelectorAll('.category-fields');
            categoryFields.forEach(field => field.style.display = 'none');
            const selectedCategory = this.value.toLowerCase() + '-fields';
            const selectedField = document.getElementById(selectedCategory);
            if (selectedField) selectedField.style.display = 'block';
        });
    }
});

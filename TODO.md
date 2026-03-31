# TODO: Add 'steps' column to subcategories table and update related files

## Migration
- [ ] Create migration to add 'steps' JSON column to subcategories table

## Model
- [ ] Update Subcategory model: add 'steps' to fillable and cast as array

## Controllers
- [ ] Update SubcategoryController (web): handle steps in store and update methods
- [ ] Update Api/SubcategoryController: add validation for steps in store and update

## Views
- [ ] Update subcategories/index.blade.php: display steps column
- [ ] Update subcategories/create.blade.php: add input for steps
- [ ] Update subcategories/edit.blade.php: add input for steps

## Testing
- [ ] Run migration
- [ ] Test API endpoints in Postman

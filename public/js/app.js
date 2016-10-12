function confirmDelete() {
    var x = confirm("Czy na pewno chcesz usunąć?");
    if (x) {
        return true;
    }else{
        return false;
    }
}
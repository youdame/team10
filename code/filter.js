function selectAll(selectAll)  {
    const checkboxes 
         = document.getElementsByName('year[]');
    
    checkboxes.forEach((checkbox) => {
      checkbox.checked = selectAll.checked;
    })
  }
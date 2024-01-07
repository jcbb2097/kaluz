     rowList = document.getElementsByClassName("acordeon");
    [].slice.call(rowList).forEach(row => {

        if (row.nextElementSibling != null) {
             classListRow = row.nextElementSibling.classList;
            if (classListRow[1] == 'tr-anidado') {
                row.firstElementChild.style.cursor = 'pointer';
                row.firstElementChild.nextElementSibling.style = 'pointer';

                row.firstElementChild.addEventListener('click', () => {
                    if (row.nextElementSibling != null) {
                         nextRow = row.nextElementSibling;

                        if (row.className != nextRow.className) {
                            if (nextRow.style.display === "table-row") {
                                nextRow.style.display = "none";
                                //row.firstElementChild.lastElementChild.innerHTML = '<i class="fas fa-chevron-left" style="margin-top: 2px;"></i>';

                            } else {
                                nextRow.style.display = "table-row";
                                //row.firstElementChild.lastElementChild.innerHTML = '<i class="fas fa-chevron-down" style="margin-top: 2px;"></i>';
                            }
                        }

                    } else {
                        console.log('no hay otra fila')
                    }

                });
            }
        }


    });

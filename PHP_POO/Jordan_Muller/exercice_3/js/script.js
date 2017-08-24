// Lancement de jQuery
            $(function() {
                // Lorsqu'on valide le formulaire
                $('#form').on('submit', function(e) {
                    e.preventDefault();

                    // On récupère la valeur des champs du formulaire
                    var marque = $('#marque').val();
                    var modele = $('#modele').val();
                    var annee = $('#annee').val();
                    var couleur = $('#couleur').val();

                    // console.log(marque, couleur, modele, annee);

                    // La méthode serialize() récupère tous les champs name d'un formulaire et nous les renvoie dans un format correct pour faire une requête ajax
                    var param = $(this).serialize();
                    // console.log(param);

                    $.ajax({
                        url: 'exercice_3_ajax.php',
                        type: 'POST',
                        data: param,
                        dataType: 'json',
                        success: function(reponse) {
                            $("#resultat").html(reponse.resultat);
                        }
                    });
                });
            });
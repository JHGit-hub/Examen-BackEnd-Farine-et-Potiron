/**
 * ============================================================
 *  Fichier : Fonctions JS principales du projet
 *  Rôle global :
 *      - Centralise toutes les fonctions JavaScript utilisées pour la manipulation des données (BDD, session), la gestion des formulaires, l'affichage dynamique et les interactions AJAX.
 *      - Facilite l’organisation et la maintenance du code client.
 *
 *  Principales fonctions :
 *      1. recordModifComment(event, divIdToHide, divIdResult)   : Enregistre les modifications d’un commentaire via AJAX et met à jour l’affichage.
 *      2. deleteComment(event, id, divIdToHide, divIdResult)    : Supprime un commentaire via AJAX et met à jour l’affichage.
 *      3. recordModifProfil(event, divIdToHide, divIdResult)    : Enregistre les modifications du profil utilisateur via AJAX.
 *      4. recordModifRecipe(event, divIdToHide, divIdResult)    : Enregistre les modifications d’une recette via AJAX.
 *      5. recordNewComment(event, divIdResult)                  : Ajoute un nouveau commentaire sur une recette via AJAX.
 *      6. removeCurrentIngredient(id, divIdResult)              : Supprime un ingrédient d’une recette (BDD) via AJAX.
 *      7. addIngredient(event, divIdResult)                     : Ajoute un ingrédient dans la session via AJAX.
 *      8. removeIngredient(event, reference, divIdResult)       : Supprime un ingrédient du tableau de session via AJAX.
 *      9. filterRecipes(event, divIdResult)                     : Filtre et affiche les recettes selon des critères dynamiques.
 *     10. showFormCreateUser(divIdToShow)                       : Affiche le formulaire de création d’utilisateur (modal, AJAX).
 *     11. showFormModifComment(id, divIdToShow)                 : Affiche le formulaire de modification d’un commentaire (modal, AJAX).
 *     12. showFormModifProfil(divIdToShow)                      : Affiche le formulaire de modification du profil utilisateur (modal, AJAX).
 *     13. showFormModifRecipe(id, divIdToShow)                  : Affiche le formulaire de modification d’une recette (modal, AJAX).
 *     14. showDetailFlour(event, divIdToShow, divIdResult)      : Affiche le détail d’une farine et le formulaire de création de recette.
 *     15. showResults(htmlAjax, divIdResult)                    : Affiche le contenu HTML reçu par AJAX dans la <div> cible.
 *     16. switchHiddenClass(divIdToHide, divIdToShow)           : Affiche ou masque une <div> selon les paramètres.
 *     17. showPassword()                                        : Affiche le champ de modification du mot de passe.
 *     18. toggleMode()                                          : Alterne entre pseudo et email pour le champ de connexion.
 *
 *  Convention :
 *      - Les fonctions sont organisées par thème (BDD, session, filtrage, affichage).
 *      - Toutes les interactions serveur passent par AJAX/fetch.
 *      - Les effets sont principalement visuels et dynamiques sur la page.
 *
 * ============================================================
 */


/******* Functions de manipulation de données dans la bdd *******/

function recordModifComment(event, divIdToHide, divIdResult) {
    // rôle:    
    //          - demander au serveur d'enregistrer les modifications du commentaire
    //          - attribuer la classe hidden à la <div> que l'on veut cacher
    //
    // paramètres (via formData):
    //          - id: id du commentaire à modifier
    //          - content: contenu du commentaire
    //          - rate: note du commentaire
    // autres paramètre:
    //          - divIdToHide: id de la <div> à cacher
    //          - divIdResult: id de la <div> qui affiche le resultat de l'ajax
    // retour:
    //          - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()


    // On retire le flou et on réactive le click sur le background
    let modalBackground = document.getElementById("modal_background")
    modalBackground.classList.add("hidden");

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére le formulaire par son id
    const form = document.getElementById("form_modif_comment"); // formulaire dans frag_form_modif_comment.php

    // Création de l'objet formData à partir du formulaire et récupération des données
    const formData = new FormData(form);

    // Construction de l'url à appeler
    let url = "ajax_save_modif_comment.php";

    // Requête avec fetch
    fetch(url, {
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass(divIdToHide, ""); // on cache le modal id="modif_comment"
            showResults(htmlAjax, divIdResult); // <div> dans recipe_page.php, incluant frag_list_comments.php, id="list_comments"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement des modifications: " + error);
            console.error(error);
        })

}

function deleteComment(event, id, divIdToHide, divIdResult){
    // rôle:    
    //          - demander au serveur de supprimer le commentaire
    //          - attribuer la classe hidden à la <div> que l'on veut cacher
    //
    // paramètres:
    //          - id: id du commentaire à supprimer
    // autres paramètre:
    //          - divIdToHide: id de la <div> à cacher
    //          - divIdResult: id de la <div> qui affiche le resultat de l'ajax
    // retour:
    //          - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()


    // On retire le flou et on réactive le click sur le background
    let modalBackground = document.getElementById("modal_background")
    modalBackground.classList.add("hidden");

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // Construction de l'url à appeler
    let url = "ajax_delete_comment.php?id=" + id;

    // Requête avec fetch
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass(divIdToHide, ""); // on cache le modal id="modif_comment"
            showResults(htmlAjax, divIdResult); // <div> dans recipe_page.php, incluant frag_list_comments.php, id="list_comments"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement des modifications: " + error);
            console.error(error);
        })

}

function recordModifProfil(event, divIdToHide, divIdResult) {
    // rôle:    
    //          - demander au serveur d'enregistrer les modifications du profil
    //          - attribuer la classe hidden à la <div> que l'on veut cacher
    //
    // paramètres (via formData):
    //          - username: pseudo de l'utilisateur
    //          - email: adresse de messagerie
    //          - password: mot de passe de l'utilisateur
    // autres paramètre:
    //          - divIdToHide: id de la <div> à cacher
    //          - divIdResult: id de la <div> qui affiche le resultat de l'ajax
    // retour:
    //          - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On retire le flou et on réactive le click sur le background
    let modalBackground = document.getElementById("modal_background")
    modalBackground.classList.add("hidden");

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére le formulaire par son id
    const form = document.getElementById("form_modif_profil"); // form dans frag_form_modif_profil.php

    // Création de l'objet formData à partir du formulaire et récupération des données
    const formData = new FormData(form);

    // Construction de l'url à appeler
    let url = "ajax_save_modif_profil.php";

    // Requête avec fetch
    fetch(url, {
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass(divIdToHide, "");
            showResults(htmlAjax, divIdResult); // <div> dans frag_edit_profil.php, id="edit-profil"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement des modifications: " + error);
            console.error(error);
        })
}

function recordModifRecipe(event, divIdToHide, divIdResult) {
    // rôle:    
    //          - demander au serveur d'enregistrer les modifications de la recette
    //          - attribuer la classe hidden à la <div> que l'on veut cacher
    //
    // paramètres (via formData):
    //          - id: id de la recette à modifier
    //          - ingredients: tableau des ingrédients (reference, quantity, unit)
    //          - title: tire de la recette
    //          - reference: reference de la recette
    //          - description: description de la recette
    //          - execution_time: temps de préparationde la recette
    //          - difficulty: difficulté de la recette
    // autres paramètre:
    //          - divIdToHide: id de la <div> à cacher
    //          - divIdResult: id de la <div> qui affiche le resultat de l'ajax
    // retour:
    //          - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére le formulaire par son id
    const form = document.getElementById("form_modif_recipe"); // form dans frag_form_modif_recipe.php

    // Création de l'objet formData à partir du formulaire et récupération des données
    const formData = new FormData(form);

    // Construction de l'url à appeler
    let url = "ajax_save_modif_recipe.php";

    // Requête avec fetch
    fetch(url, {
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass(divIdToHide, ""); // on cache le modal id="modif_recipe"
            showResults(htmlAjax, divIdResult); // <div> dans recipe_page.php, incluant frag_detail_recipe.php, id="detail_recipe"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement des modifications: " + error);
            console.error(error);
        })
}

function recordNewComment(event, divIdResult) {
    // rôle:
    //      - enregistrer un nouveau commentaire et/ou note dans la bdd
    //      - attribuer la classe hidden à la <div> que l'on veut cacher 
    // paramètres (via formData):
    //      - id: id de la recette
    //      - content: contenu du commentaire
    //      - rate: note du commentaire
    // autres paramètres:
    //      - divIdResult: id de la <div> qui affiche le resultat de l'ajax
    // retour:
    //      - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére le formulaire par son id
    const form = document.getElementById("form_new_comment"); // form dans recipe_page.php, incluant frag_form_create_comment.php

    // Création de l'objet formData à partir du formulaire et récupération des données
    const formData = new FormData(form);

    // Construction de l'url à appeler
    let url = "ajax_save_new_comment.php";

    // Requête avec fetch
    fetch(url, {
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(htmlAjax => {
            showResults(htmlAjax, divIdResult); // <div> dans recipe_page.php, incluant frag_list_comments, id="list_comments"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement du commentaire: " + error);
            console.error(error);
        })

}

function removeCurrentIngredient(id, divIdResult) {
    // rôle:
    //      - demande au serveur de supprimer un ingredient de la liste des ingredients de la recette enregistrés dans la bdd
    // paramètres(via $_GET):
    //      - id: id de l'ingredient a supprimer
    // autre paramètre:
    //      - divIdResult: id de la <div> qui affiche le resultat de l'ajax
    // retour:
    //      - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // Construction de l'url
    let url = "ajax_remove_ingredient_from_recipe.php?id=" + encodeURIComponent(id);

    // Requête fetch
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            showResults(htmlAjax, divIdResult) // <div> dans frag_list_current_ingredients.php, id="list_current_ingredients"
        })
        .catch(error => {
            alert("Erreur lors de la suppression de l'ingrédient : " + error);
            console.log(error);
        });

}


/****** Functions de manipulation de données dans la session  ******/

function addIngredient(event, divIdResult) {
    // rôle:
    //      - demander au controleur AJAX d'enregistrer un nouvel ingredient dans un tableau de la session
    // paramètres (via querySelector):
    //      - reference: nom de l'ingredient
    //      - quantity: quantité
    //      - unit: unité de mesure
    // autres paramètres:
    //      - divIdResult: id de la <div> qui va afficher le resultat
    // retour:
    //      - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére les valeurs issus du formulaire
    const reference = document.querySelector('input[name="reference"]').value;
    const quantity = document.querySelector('input[name="quantity"]').value;
    const unit = document.querySelector('input[name="unit"]').value;

    // On verifie que les champs ne sont pas vide
    if (!reference || !quantity || !unit) {
    alert("Tous les champs doivent être remplis.");
    return;
    }

    // Construction de l'url à appeler
    let url = "ajax_add_ingredient_into_array.php?reference=" + encodeURIComponent(reference) + "&quantity=" + encodeURIComponent(quantity) + "&unit=" + encodeURIComponent(unit);

    // Requête avec fetch
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            showResults(htmlAjax, divIdResult); // <div> dans frag_list_ingredients, id="list_ingredients"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement de l'ingredient: " + error);
            console.log(error);
        })

}

function removeIngredient(event, reference, divIdResult) {
    // rôle:
    //      - demander au controleur AJAX de supprimer un ingredient du tableau de la session
    // paramètres (via $_GET):
    //      - reference: nom de l'ingredient
    // autres paramètres:
    //      - divIdResult: id de la <div> qui va afficher le resultat
    // retour:
    //      - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // Construction de l'url à appeler
    let url = "ajax_remove_ingredient_from_array.php?reference=" + encodeURIComponent(reference);

    // Requête avec fetch
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            showResults(htmlAjax, divIdResult); // <div> dans frag_list_ingredients, id="list_ingredients"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement des modifications: " + error);
            console.log(error);
        })

}


/******* functions de filtrage de données *******/

function filterRecipes(event, divIdResult) {
    // rôle:
    //      - Demander au serveur la liste des recettes selon les critéres selectionnés par l'utilisateur
    // paramètres (via querySelector):
    //      - flour_1: reference de la farine issu du catalogue farine (issu de l'API)
    //      - flour_2: reference de la farine issu du catalogue farine (issu de l'API)
    //      - difficulty: difficulté de la recette (issu de la table recipes)
    // autres paramètres:
    //      - divIdResult: id de la <div> qui va afficher le resultat
    // retour:
    //      - renvoi le resultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére les valeurs issus du formulaire
    const flour_1 = document.querySelector('select[name="flour_1"]').value;
    const flour_2 = document.querySelector('select[name="flour_2"]').value;
    const difficulty = document.querySelector('select[name="difficulty"]').value;

    // Construction de l'url
    let url = "ajax_filter_recipes.php?difficulty=" + encodeURIComponent(difficulty) + "&flour_1=" + encodeURIComponent(flour_1) + "&flour_2=" + encodeURIComponent(flour_2);
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            showResults(htmlAjax, divIdResult); // <div> dans homepage.php, id="list_recipes", incluant frag_list_recipes.php
        })
        .catch(error => {
            console.error("Erreur lors de la récupération des recettes :", error);
            console.log(error);
        });
}


/******* functions d'affichage d'éléments *******/



function showFormCreateUser(divIdToShow) {
    // rôle: 
    //      - retirer la classe hidden à la <div> que l'on veut afficher
    //      - demander au serveur de préparer un formulaire de création d'utilisateur
    // paramètre:
    //      - divIdToShow: id de la <div> à afficher
    // retour:
    //      - renvoi le resultat (fragment HTML) de l'ajax à la fonction showResults()

    // On floute et empeche le click sur le background
    let modalBackground = document.getElementById("modal_background");
    modalBackground.classList.remove("hidden");

    // Construction de l'url
    let url = "ajax_init_form_create_user.php";
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass("", divIdToShow)
            showResults(htmlAjax, divIdToShow); // <div> dans homepage.php, id="create_user", incluant frag_form_create_user.php
        })
        .catch(error => {
            alert("Erreur lors de l'ouverture du formulaire de création : " + error);
            console.error(error);
        })

}

function showFormModifComment(id, divIdToShow) {
    // rôle:
    //      - retirer la classe hidden à la <div> que l'on veut afficher (modal)
    //      - demander au serveur de préparer un formulaire de modification pré-rempli
    // paramètres:
    //      - divIdToShow: id de la <div> à afficher
    //      - id: identifiant du commentaire à modifier
    // retour:
    //          - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On floute et empêche le click sur le background
    let modalBackground = document.getElementById("modal_background")
    modalBackground.classList.remove("hidden");

    // Construction de l'url
    let url = "ajax_init_form_modif_comment.php?id=" + encodeURIComponent(id);

    // Requête fetch
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass("", divIdToShow)
            showResults(htmlAjax, divIdToShow) // <div> dans recipe_page.php, incluant frag_form_modif_comment.php, id="modif_comment"
        })
        .catch(error => {
            alert("Erreur lors de l'ouverture du formulaire de modification : " + error);
            console.error(error);
        })
}

function showFormModifProfil(divIdToShow) {
    // rôle: 
    //          - retirer la classe hidden à la <div> que l'on veut afficher (modal)
    //          - demander au serveur de préparer un formulaire de modification pré-rempli
    // paramètres:
    //          - divIdToShow: id de la <div> à afficher
    // retour:
    //          - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On floute et empêche le click sur le background
    let modalBackground = document.getElementById("modal_background")
    modalBackground.classList.remove("hidden");

    // Construction de l'url
    let url = "ajax_init_form_modif_profil.php";

    // Requête fetch
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass("", divIdToShow)
            showResults(htmlAjax, divIdToShow) // <div> dans user_page,incluant frag_form_modif_profil.php, id="modif_profil"
        })
        .catch(error => {
            alert("Erreur lors de l'ouverture du formulaire de modification : " + error);
            console.error(error);
        })
}

function showFormModifRecipe(id, divIdToShow) {
    // rôle: 
    //          - retirer la classe hidden à la <div> que l'on veut afficher (modal)
    //          - demander au serveur de préparer un formulaire de modification pré-rempli
    // paramètres:
    //          - id: identifiant de la recette
    //          - divIdToShow: id de la <div> à afficher
    // retour:
    //          - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On floute et empêche le click sur le background
    let modalBackground = document.getElementById("modal_background")
    // modalBackground.classList.remove("hidden");

    // Construction de l'url
    let url = "ajax_init_form_modif_recipe.php?id=" + encodeURIComponent(id);

    // Requête fetch
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass("", divIdToShow)
            showResults(htmlAjax, divIdToShow) // <div> dans recipe_page, incluant frag_form_modif_recipe.php, id="modif_recipe"
        })
        .catch(error => {
            alert("Erreur lors de l'ouverture du formulaire de modification : " + error);
            console.error(error);
        })
}

function showDetailFlour(event, divIdToShow, divIdResult) {
    // rôle:
    //      - demander au controleur d'extraire le detail de la farine selectionné et d'afficher le formulaire de création de recette    
    // paramètre (via querySelector):
    //      - reference: reference de la farine
    // autres paramètres:
    //      - divIdResult: id de la <div> qui va afficher le resultat
    //      - divIdToShow: id de la <div> à afficher
    // retour
    //      - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére les valeurs issu du form
    const reference = document.querySelector('select[name="reference"]').value;

    // Construction de l'url
    let url = "ajax_extract_detail_flour.php?reference=" + encodeURIComponent(reference);
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass("", divIdResult);
            switchHiddenClass("", divIdToShow); // <div> dans create_recipe.php, incluant frag_form_create_recipe.php, id="form_create_recipe"
            showResults(htmlAjax, divIdResult); // <div> dans create_recipe.php, incluant frag_detail_flour.php, id="detail_flour"

            // Si le fragment d’erreur est présent, on cache la div du formulaire
            if (htmlAjax.includes('error-msg')) {
                document.getElementById(divIdToShow).style.display = 'none';
                // On affiche la div du message d'erreur
                switchHiddenClass("", "error_container");
                showResults(htmlAjax, "error_container");
            } else {
                switchHiddenClass("error_container","");
                document.getElementById(divIdToShow).style.display = '';
            }
        })
        .catch(error => {
            alert("Erreur lors de la récupération des recettes :", error);
            console.error(error);
        });
}


function showResults(htmlAjax, divIdResult) {
    // rôle:
    //      - afficher les resultats reçu par ajax dans les <div> correspondantes
    // paramètres:
    //      - htmlAjax: code HTML à afficher
    //      - divIdResult: id de la div dans lequel on affiche le résultat de l'ajax
    // retour:
    //      - affiche le resultat dans la <div> de l'id défini

    // On récupére la <div> à partir de son id
    let resultDiv = document.getElementById(divIdResult);

    // On remplace le contenu de la <div> par le fragment
    resultDiv.innerHTML = htmlAjax;

}

function switchHiddenClass(divIdToHide = "", divIdToShow = "") {
    // rôle: 
    //      - retirer la classe hidden de la <div> que l'on veut afficher
    //      - ajouter la classe hidden a celle que l'on veut cacher
    // paramètres:
    //      - divIdToHide: id de la <div> que l'on veut cacher
    //      - divIdToShow: id de la <div> que l'on veut afficher
    // retour:
    //      - néant

    // On récupére les <div> en utilisant les id
    let divToHide = document.getElementById(divIdToHide);
    let divToShow = document.getElementById(divIdToShow);

    // On verifie l'existence des <div> avant d'agir dessus
    if (divToHide) { divToHide.classList.add("hidden") };
    if (divToShow) { divToShow.classList.remove("hidden") };


}

function showPassword() {
    // rôle : 
    //      - afficher le champ du mot de passe dans le formulaire pour permettre sa modification
    // paramètre:
    //      - néant
    // retour : 
    //      - néant
    document.getElementById("modif_password").style.display = "flex";
}

function toggleMode() {
    // Rôle:
    //      - choisir entre le pseudo ou l'email comme identifiant
    // paramètres:
    //      - (via getElementById) login_select: choix du mode de connexion par le select
    //      - (via getElementById) login_label: label du champ de connexion
    //      - (via getElementById) login_input: champ de saisie du login
    // retour:
    //      - changement des valeurs du label, type et input


    // On récupére les éléments
    const mode = document.getElementById('login_mode').value;
    const label = document.getElementById('login_label');
    const input = document.getElementById('login_input');

    if (mode === 'email') {
        label.innerText = 'Email :';
        input.type = 'email';
        input.placeholder = "Entrez votre Email";
    } else {
        label.innerText = 'Pseudo :';
        input.type = 'text';
        input.placeholder = "Entrez votre pseudo";
    }
}

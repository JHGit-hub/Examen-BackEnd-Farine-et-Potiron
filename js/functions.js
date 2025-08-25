



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
            switchHiddenClass(divIdToHide, "");
            showResults(htmlAjax, divIdResult); // <div> dans frag_list_comments.php, id="list_comments"
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
            switchHiddenClass(divIdToHide, "");
            showResults(htmlAjax, divIdResult); // <div> dans frag_detail_recipe.php, id="detail_recipe"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement des modifications: " + error);
            console.error(error);
        })
}

function recordNewComment(event, divIdToHide, divIdResult) {
    // rôle:
    //      - enregistrer un nouveau commentaire et/ou note dans la bdd
    //      - attribuer la classe hidden à la <div> que l'on veut cacher 
    // paramètres (via formData):
    //      - id: id de la recette
    //      - content: contenu du commentaire
    //      - rate: note du commentaire
    // autres paramètres:
    //      - divIdToHide: id de la <div> à cacher
    //      - divIdResult: id de la <div> qui affiche le resultat de l'ajax
    // retour:
    //      - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére le formulaire par son id
    const form = document.getElementById("form_new_comment"); // form dans frag_form_create_comment.php

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
            switchHiddenClass(divIdToHide, "");
            showResults(htmlAjax, divIdResult); // <div> dans frag_list_comments, id="list_comments"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement du commentaire: " + error);
            console.error(error);
        })

}

function removeCurrentIngredient(id, divIdResult) {
    // rôle:
    //      - demande au serveur de supprimer un ingredient de la liste des ingredients de la recette enregistrés dans la bdd
    //      - afficher la liste des ingredients mise à jour
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
    // paramètres (via formData):
    //      - reference: nom de l'ingredient
    //      - quantity: quantité
    //      - unit: unité de mesure
    // autres paramètres:
    //      - divIdResult: id de la <div> qui va afficher le resultat
    // retour:
    //      - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére le formulaire par son id
    const form = document.getElementById("form_add_ingredient"); // form dans frag_form_add_ingredients.php 

    // Création de l'objet formData à partir du formulaire et récupération des données
    const formData = new FormData(form);

    // Construction de l'url à appeler
    let url = "ajax_add_ingredient_into_array.php";

    // Requête avec fetch
    fetch(url, {
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(htmlAjax => {
            form.reset();
            showResults(htmlAjax, divIdResult); // <div> dans frag_list_ingredients, id="list_ingredients"
        })
        .catch(error => {
            alert("Erreur lors de l'enregistrement de l'ingredient: " + error);
            console.log(error);
        })

}

function removeIngredient(reference, divIdResult) {
    // rôle:
    //      - demander au controleur AJAX de supprimer un ingredient du tableau de la session
    // paramètres (via $_GET):
    //      - reference: nom de l'ingredient
    // autres paramètres:
    //      - divIdResult: id de la <div> qui va afficher le resultat
    // retour:
    //      - renvoi le résultat (fragment HTML) de l'ajax à la fonction showResults()

    // Construction de l'url à appeler
    let url = "ajax_add_ingredient_into_array.php?reference=" + encodeURIComponent(reference);

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
    //      - reference: reference de la farine issu du catalogue farine (issu de l'API)
    //      - difficulty: difficulté de la recette (issu de la table recipes)
    // autres paramètres:
    //      - divIdResult: id de la <div> qui va afficher le resultat
    // retour:
    //      - renvoi le resultat (fragment HTML) de l'ajax à la fonction showResults()

    // On empêche l'envoi du formulaire
    event.preventDefault();

    // On récupére les valeurs issus du formulaire
    const reference = document.querySelector('select[name="reference"]').value;
    const difficulty = document.querySelector('select[name="difficulty"]').value;


    // Construction de l'url
    let url = "ajax_filter_recipes.php?difficulty=" + encodeURIComponent(difficulty) + "&reference=" + encodeURIComponent(reference);
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            showResults(htmlAjax, divIdResult); // <div> dans frag_list_recipes.php, id="list_recipes"
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
            showResults(htmlAjax, divIdToShow); // <div> dans frag_form_create_user.php, id="create_user"
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
            showResults(htmlAjax, divIdToShow) // <div> dans frag_form_modif_comment.php, id="modif_comment"
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
            showResults(htmlAjax, divIdToShow) // <div> dans frag_form_modif_profil.php, id="modif_profil"
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
    modalBackground.classList.remove("hidden");

    // Construction de l'url
    let url = "ajax_init_form_modif_recipe.php?id=" + encodeURIComponent(id);

    // Requête fetch
    fetch(url)
        .then(response => response.text())
        .then(htmlAjax => {
            switchHiddenClass("", divIdToShow)
            showResults(htmlAjax, divIdToShow) // <div> dans frag_form_modif_recipe.php, id="modif_recipe"
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
            switchHiddenClass("", divIdToShow); // <div> dans frag_form_create_recipe.php, id="create_recipe"
            showResults(htmlAjax, divIdResult); // <div> dans frag_list_recipes.php, id="list_recipes"
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
    //      - retirer la classe hidden de la <div> que l'on veut afficher et ajouter la classe hidden a celle que l'on veut cacher
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
    document.getElementById("modifPassword").style.display = "block";
}

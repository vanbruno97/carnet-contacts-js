// Définition des variables générales
const addContactBtn = document.querySelector('.add-contact-btn');
const formContainer = document.querySelector('.form-container');
const cancelBtn = document.querySelector('.cancel-btn');
const addBtn = document.querySelector('.add-btn');
const contactsList = document.querySelector('.contacts-list');
const empty = document.getElementById('empty');
const actions = document.querySelector('.actions')

// Apparition du formulaire
addContactBtn.addEventListener('click', () => {
	formContainer.style.display = 'block';
	addContactBtn.classList.add('hide');
});
// Fermeture du formulaire
cancelBtn.addEventListener('click', () => {
	formContainer.style.display = 'none';
	addContactBtn.classList.remove('hide');
});

// Ajout de l'évènement sur le bouton ajouter à la fin du formulaire
addBtn.addEventListener('click', (e) => {
	e.preventDefault();
	// Attribution des valeurs du formulaire
	const nom = document.getElementById('nom').value;
	const prenom = document.getElementById('prenom').value;
	const pays = document.getElementById('pays').value;
	const genre = document.getElementById('genre').value;
	const email = document.getElementById('email').value;
	const telephone = document.getElementById('telephone').value;
	const dateNaissance = document.getElementById('date-naissance').value;
	const image = document.getElementById('image').files[0];
// Création de la liste 
// l'on définit l'objet contact
const contact = {
	nom,
	prenom,
	pays,
	genre,
	email,
	telephone,
	dateNaissance,
	image: URL.createObjectURL(image),
};
// Création de la liste dans le doc HTML
	const newContact = document.createElement('li');
	
	newContact.innerHTML = `
	    <div class = "contact-info">
	    <img src= "${contact.image}" alt="${contact.nom} ${contact.prenom}">
		<div class = "details">
		<h3>${contact.nom} ${contact.prenom}</h3>
		<p>${contact.pays}</p>
		<p>${contact.genre}</p>
		<p>${contact.email}</p>
		<p>${contact.telephone}</p>
		<p>${contact.dateNaissance}</p>
		</div>
		<div class="actions">
      <button class="edit-btn">Modifier</button>
      <button class="delete-btn">Supprimer</button>
    </div>
		</div>
		
	`;
	contactsList.appendChild(newContact);
	// Conditions permettant la disparition du formulaire au clic
	formContainer.style.display = 'none';
	document.querySelector('form').reset();
	addContactBtn.classList.remove('hide');
	empty.style.display = 'none';
	// Modification du formulaire
	const editBtn = document.querySelector('.edit-btn');
	editBtn.addEventListener('click' , () => {
		formContainer.style.display = 'block';
	});
});
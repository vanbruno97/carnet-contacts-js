const addContactBtn = document.querySelector('.add-contact-btn');
const formContainer = document.querySelector('.form-container');
const cancelBtn = document.querySelector('.cancel-btn');
const addBtn = document.querySelector('.add-btn');
const contactsList = document.querySelector('.contacts-list');

addContactBtn.addEventListener('click', () => {
	formContainer.style.display = 'block';
});

cancelBtn.addEventListener('click', () => {
	formContainer.style.display = 'none';
});

addBtn.addEventListener('click', (e) => {
	e.preventDefault();
	const nom = document.getElementById('nom').value;
	const prenom = document.getElementById('prenom').value;
	const pays = document.getElementById('pays').value;
	const genre = document.getElementById('genre').value;
	const email = document.getElementById('email').value;
	const telephone = document.getElementById('telephone').value;
	const dateNaissance = document.getElementById('date-naissance').value;

	const newContact = document.createElement('li');
	newContact.classList.add('contact');
	newContact.innerHTML = `
		<p>${nom} ${prenom}</p>
		<p>Pays: ${pays}</p>
		<p>Genre: ${genre}</p>
		<p>E-mail ${email}</p>
		<p>Téléphone: ${telephone}</p>
		<p>Date de naissance: ${dateNaissance}</p>
	`;

	contactsList.appendChild(newContact);
	formContainer.style.display = 'none';
	document.querySelector('form').reset();
});
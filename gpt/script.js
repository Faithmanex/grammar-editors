const form = document.querySelector('form');
const priceDiv = document.querySelector('#price');

form.addEventListener('submit', function(e) {
	e.preventDefault();

	const documentLength = parseInt(document.querySelector('#document-length').value);
	const turnaroundTime = parseInt(document.querySelector('#turnaround-time').value);
	let price = 0;

	if (documentLength <= 500) {
		price += 5;
	} else {
		price += Math.ceil(documentLength / 500) * getPricePer500Words(turnaroundTime);
	}

	if (document.querySelector('#formatting').checked) {
		price += 10;
	}

	if (document.querySelector('#reference-checking').checked) {
		price += 20;
	}

	priceDiv.innerHTML = `Price: $${price.toFixed(2)}`;
});

function getPricePer500Words(turnaroundTime) {
	if (turnaroundTime === 24) {
		return 10;
	} else if (turnaroundTime === 48) {
		return 7;
	} else if (turnaroundTime === 72) {
		return 5;
	}
}

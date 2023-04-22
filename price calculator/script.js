function calculateCost() {
	const wordCount = document.getElementById("wordCount").value;
	const turnaroundTime = document.getElementById("turnaroundTime").value;
	let totalCost = 0;
	if (wordCount <= 500) {
		totalCost = 5;
	} else {
		totalCost = Math.ceil(wordCount / 500) * 5;
	}
	if (turnaroundTime == 24) {
		totalCost *= 2;
	} else if (turnaroundTime == 48) {
		totalCost *= 1.5;
	}
	document.getElementById("totalCost").innerHTML = totalCost;
}

document.getElementById("wordCount").addEventListener("input", calculateCost);
document.getElementById("turnaroundTime").addEventListener("change", calculateCost);

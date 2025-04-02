
function submitVote() {
    if (localStorage.getItem("hasVoted")) {
        document.getElementById("result").innerText = "You have already voted. Voting is allowed only once.";
        return;
    }
    
    let selectedCandidates = Array.from(document.querySelectorAll('input[name="candidate"]:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedCandidates.length === 0) {
        document.getElementById("result").innerText = "You didn't select any candidates.";
        return;
    }
    
    localStorage.setItem("hasVoted", true);
    document.getElementById("result").innerText = "You voted for: " + selectedCandidates.join(", ");
    
    document.querySelectorAll('input[name="candidate"]').forEach(checkbox => {
        checkbox.disabled = true;
    });
    document.querySelector(".submit-button").disabled = true;
}

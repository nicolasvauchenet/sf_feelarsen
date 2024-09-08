import {Controller} from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["card"];

    connect() {
        this.shuffleCards();
    }

    shuffleCards() {
        const grid = this.element;

        const shuffleCards = this.cardTargets;
        const nonShuffleCards = document.querySelectorAll('.app-card.inactive');

        this.shuffleArray(shuffleCards);

        grid.innerHTML = '';
        this.appendCardsToGrid(grid, shuffleCards);
        this.appendCardsToGrid(grid, nonShuffleCards);
    }

    shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    appendCardsToGrid(grid, cards) {
        cards.forEach(card => grid.appendChild(card));
    }
}

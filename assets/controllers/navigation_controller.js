import {Controller} from "@hotwired/stimulus";

export default class extends Controller {
    static targets = ["link", "section"];

    connect() {
        this.updateActiveLink();

        window.addEventListener('scroll', this.updateActiveLink.bind(this));

        this.linkTargets.forEach(link => {
            link.addEventListener('click', this.scrollToSection.bind(this));
        });

        if (window.location.hash) {
            console.log(window.location.hash);
            this.scrollToSectionByHash(window.location.hash);
        } else {
            this.scrollToTop();
        }
    }

    disconnect() {
        window.removeEventListener('scroll', this.updateActiveLink.bind(this));
    }

    updateActiveLink() {
        let currentSection = null;

        this.sectionTargets.forEach(section => {
            const sectionTop = section.getBoundingClientRect().top;
            const offset = 7.25 * parseFloat(getComputedStyle(document.documentElement).fontSize);

            if (sectionTop <= offset + 30) {
                currentSection = section;
            }
        });

        if (currentSection) {
            const id = currentSection.getAttribute('id');
            const activeLink = this.linkTargets.find(link => link.getAttribute('href') === `#${id}`);
            this.activateLink(activeLink);
        }
    }

    activateLink(link) {
        this.linkTargets.forEach(l => l.classList.remove('active'));
        if (link) {
            link.classList.add('active');
        }
    }

    scrollToSection(event) {
        event.preventDefault();

        const targetId = event.currentTarget.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            const offset = 7.25 * parseFloat(getComputedStyle(document.documentElement).fontSize);
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });

            history.pushState(null, null, `#${targetId}`);
        }
    }

    scrollToSectionByHash(hash) {
        const targetId = hash.substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            const offset = 7.5 * parseFloat(getComputedStyle(document.documentElement).fontSize);
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });
        }
    }

    scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
}

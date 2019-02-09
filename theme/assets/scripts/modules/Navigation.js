import DataJs from '../utilities/data';
import Booleanify from '../utilities/booleans';
import { debounce } from 'lodash';

export default class Navigation {
  constructor() {
    this.wrapper = DataJs({ element: 'Navigation.Wrapper' });
    this.toggle = DataJs({ element: 'Navigation.Toggle' });
    this.observeToggle();
    this.observeWindow();
  }

  observeToggle() {
    this.toggle.addEventListener('click', this.handleToggleClick.bind(this));
  }

  observeWindow() {
    window.addEventListener('resize', debounce(this.closeMenu.bind(this), 250));
  }

  handleToggleClick() {
    this.toggleMenu();
    this.toggleBtnText();
  }

  toggleMenu() {
    let menuState = Booleanify(this.wrapper.getAttribute('aria-expanded'));
    this.menuState = !menuState;
    this.wrapper.setAttribute('aria-expanded', this.menuState);
  }

  toggleBtnText() {
    this.menuState ? this.toggle.innerHTML = 'x' : this.toggle.innerHTML = 'Menu';
  }

  closeMenu() {
    this.wrapper.setAttribute('aria-expanded', false);
    this.toggle.innerHTML = 'Menu';
  }
}

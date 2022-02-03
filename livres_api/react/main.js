class Livres extends React.Component {
  constructor() {
    super();
    this.state = {
      showPopup: false,
    };

  }
  togglePopup() {
    this.setState({
      showPopup: !this.state.showPopup
    });
  }
  togglePopupEdit() {
    this.setState({
      showPopupEdit: !this.state.showPopup
    });
  }
  handleChange(event) {
    this.setTitre(event.target.title);
  }
  render() {
    return (

      <div class="col-12 col-md-3 mx-2 border-livre">
        <div className="buble">{this.props.empId}</div>
        <div>{this.props.auteur}</div>
        <h1>{this.props.title}</h1>
        <button class="btn btn-primary" onClick={this.togglePopup.bind(this)}>Voir</button>
        <button class="btn btn-primary" onClick={this.togglePopupEdit.bind(this)}>Edit</button>
        {this.state.showPopup ?
          <Popup
            text='Close Me'
            title={this.props.title}
            auteur={this.props.auteur}
            closePopup={this.togglePopup.bind(this)}
          />
          : null
        }
        {this.state.showPopupEdit ?
          <PopupEdit
            text='Close Me'
            title={this.props.title}
            auteur={this.props.auteur}
            closePopup={this.togglePopupEdit.bind(this)}
          />
          : null
        }
      </div>

    );
  }
}

class Utilisateur extends React.Component {
  render() {
    return (
      <div class='row border-user mb-3'>
        <div class="col-12">
          <p><strong>Nom</strong> : {this.props.nom} / <strong>Prénom</strong> : {this.props.prenom} / <strong>Age</strong> : {this.props.age} / <strong>Bibliotheque de</strong> {this.props.biblio}</p>
        </div>
      </div>
    );
  }
}

class Auteur extends React.Component {
  render() {
    return (
      <div class="col-6 my-2">
        <div class="col-12 pl-5 bloc-auteur">
          <h1>{this.props.auteur}</h1>
          <p>Oeuvre : {this.props.oeuvre}</p>
        </div>
      </div>

    );
  }
}


class Popup extends React.Component {
  render() {
    return (
      <div className='popup'>
        <div className='popup_inner'>
          <h1>Titre : {this.props.title}</h1>
          <p>Auteur : {this.props.auteur}</p>
          <button class="btn btn-primary" onClick={this.props.closePopup}>FERMER</button>
        </div>
      </div>
    );
  }
}

class PopupEdit extends React.Component {
  render() {
    return (
      <div className='popup_edit'>
        <div className='popup_inner'>
          <form>
            <h1>Edit</h1>
            <label for="titre">Titre:</label>
            <input type="text" id="titre" name="titre" value={this.props.title}
              size="10" onChange={this.handleChange} />
            <label for="auteur">Auteur:</label>
            <input type="text" id="auteur" name="auteur"
              size="10" onChange={this.handleChange} />
            <button class="btn btn-primary" onClick={this.props.closePopup}>FERMER</button>
          </form>
        </div>
      </div>
    );
  }
}

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      showUtilisateurs: false,
      showAuteur: false,
      showBibliotheque: false,
    };
  }

  toggleUtilisateurs() {
    this.setState({
      showUtilisateurs: !this.state.showPopup,
      showAuteur: false,
      showBibliotheque: false,
    });
    console.log(Utilisateurs)
  }
  toggleAuteur() {
    this.setState({
      showAuteur: !this.state.showPopup,
      showUtilisateurs: false,
      showBibliotheque: false,
    });
    console.log(Auteur)
  }
  toggleBibliotheque() {
    this.setState({
      showBibliotheque: !this.state.showPopup,
      showUtilisateurs: false,
      showAuteur: false,
    });
    console.log(Bibliotheque)
  }

  render() {
    return (
      <div>
        <nav>
          <ul className='liste'>
            <li className='items' onClick={this.toggleBibliotheque.bind(this)}>
              Bibliotheque
            </li>
            <li className='items' onClick={this.toggleUtilisateurs.bind(this)}>
              Utilisateurs
            </li>
            <li className='items' onClick={this.toggleAuteur.bind(this)}>
              Auteurs
            </li>
          </ul>
        </nav>
        <div>
          <div class="container">
            <div class="row justify-content-center">
              {this.state.showBibliotheque ?
                <Bibliotheque>

                </Bibliotheque>
                : null
              }
              {this.state.showUtilisateurs ?
                <Utilisateurs>

                </Utilisateurs>
                : null
              }
              {this.state.showAuteur ?
                <Auteurs>

                </Auteurs>
                : null
              }</div>
          </div>
        </div>
      </div>

    )
  }
}

class Auteurs extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      menuOpen: false,
      auteurs: [
        { empId: 1, auteur: "Jean", oeuvre: "Il etait..." },
        { empId: 2, auteur: "Pauleta", oeuvre: "Ivanka..." },
        { empId: 3, auteur: "Christian", oeuvre: "Kushner..." }
      ]
    };
  }

  render() {
    // Array of <Auteur>
    var listauteur = this.state.auteurs.map(e => (
      <Auteur auteur={e.auteur} oeuvre={e.oeuvre} />
    ));
    return (
      <div class="col-auto">
        <h1>Liste des auteurs</h1>
        <div class="container">
          <div class="row">
            {listauteur}
          </div>
        </div>
      </div>
    );
  }
}

class Utilisateurs extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      menuOpen: false,
      users: [
        { empId: 1, nom: "Artur", prenom: "Lagarde", age: "23 ans", biblio: "Plescop" },
        { empId: 2, nom: "Artur", prenom: "Lagarde", age: "55 ans", biblio: "Vannes" },
        { empId: 3, nom: "Artur", prenom: "Lagarde", age: "34 ans", biblio: "Plescop" }
      ]
    };
  }

  render() {
    // Array of <Utilisateurs>
    var listusers = this.state.users.map(e => (
      <Utilisateur nom={e.nom} prenom={e.prenom} age={e.age} biblio={e.biblio} />
    ));
    return (
      <div class="col-auto">
        <h1>Liste des utilisateurs</h1>
        <div class="container">
          <div class="row">
            {listusers}
          </div>
        </div>
      </div>
    );
  }
}

class Bibliotheque extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      menuOpen: false,
      livres: [
        { empId: 1, title: "Il etait...", auteur: "Jean" },
        { empId: 2, title: "Ivanka...", auteur: "Pauleta" },
        { empId: 3, title: "Kushner...", auteur: "Christian" }
      ]
    };
  }
  toggleUtilisateurs() {
    this.setState({
      showUtilisateurs: !this.state.showPopup
    });
  }
  toggleAuteur() {
    this.setState({
      showAuteur: !this.state.showPopup
    });
  }
  toggleBibliotheque() {
    this.setState({
      showBibliotheque: !this.state.showPopup
    });
  }

  render() {
    // Array of <Livres>
    var listItems = this.state.livres.map(e => (
      <Livres empId={e.empId} title={e.title} auteur={e.auteur} />
    ));
    return (

      <div class="col-10">
        <h1>Liste des livres</h1>
        <p>Voici les livres disponibles</p>
        <div class="container">
          <div class="row">
            {listItems}
          </div>
        </div>
      </div>
    );
  }
}

ReactDOM.render(
  <App />,
  document.getElementById('root')
);
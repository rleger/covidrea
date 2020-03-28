import { HomePage } from '../page-objects/homepage.js';

describe('Check homepage buttons', function() {
    it('Open Covid Moi Un Lit websiteand check if buttons exits', function() {
        cy.visit('https://covid-moi-un-lit.com/')

        // Check buttons are present
        cy.contains(HomePage.ButtonSearchABed, 'Rechercher un lit')
        cy.contains(HomePage.ButtonUpdateMyBeds, 'Mettre à jour mes lits')
    })
  })


describe('Click on "Rechercher un lit" button without authentification', function() {
    it('Click on "Rechercher un lit" button must redirect to login page', function() {
        cy.visit('https://covid-moi-un-lit.com/')

        // Click on "Rechercher un lit"
        cy.contains(HomePage.ButtonSearchABed, 'Rechercher un lit').click()

        // We should be redirected to login page
        cy.url().should('include', '/login')
    })
})

describe('Click on "Mettre à jour mes lits" button without authentification', function() {
    it('Click on "Mettre à jour mes lits" button must redirect to login page', function() {
        cy.visit('https://covid-moi-un-lit.com/')

        // Click on "Mettre à jour mes lits"
        cy.contains(HomePage.ButtonUpdateMyBeds, 'Mettre à jour mes lits').click()

        // We should be redirected to login page
        cy.url().should('include', '/login')
    })
})

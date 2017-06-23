@api
Feature: Pager

  Background:
    Given "150" nodes of type "article"

  Scenario: Pagination.
    Given I am logged in as a user with the "administrator" role
    When I visit "/node"
    Then I should see "Page 1 2 3 4 5 … 15 Next ›" in the "pager"

    When I click "5" in the "pager"
    And I click "7" in the "pager"
    Then I should see "‹ Previous 1 … 3 4 5 6 Page 7 8 9 10 11 … 15 Next ›" in the "pager"


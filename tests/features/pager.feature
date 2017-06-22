@api
Feature: Pager

  Background:
    Given "100" nodes of type "article"

  Scenario: Pagination.
    Given I am logged in as a user with the "administrator" role
    When I visit "/node"

    Then I should see the link "next ›" in the "pager"
    But I should not see the link "‹ previous" in the "pager"
    And I should see the ".pager-ellipsis" element in the "pager"
    And the ".ecl-pager__item--current" element should contain "1"

    When I click "next ›" in the "pager"
    Then I should see the link "‹ previous" in the "pager"
    And the ".ecl-pager__item--current" element should contain "2"

@api
Feature: Pager

  Scenario: Pager behaves correctly with a high number of pages.
    Given "500" nodes of type "article"

    When I visit "/node"
    Then I should see "Page 1 2 3 4 5 6 7 8 9 … 50 Next ›" in the "pager"
    And I should not see the link "‹ Previous"

    When I click "Next ›"
    Then I should see "‹ Previous 1 Page 2 3 4 5 6 7 8 9 … 50 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 Page 3 4 5 6 7 8 9 … 50 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 Page 4 5 6 7 8 9 … 50 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 Page 5 6 7 8 9 … 50 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 5 Page 6 7 8 9 10 … 50 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 … 3 4 5 6 Page 7 8 9 10 11 … 50 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 … 4 5 6 7 Page 8 9 10 11 12 … 50 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 … 5 6 7 8 Page 9 10 11 12 13 … 50 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 … 6 7 8 9 Page 10 11 12 13 14 … 50 Next ›" in the "pager"

    And I click "50"
    Then I should see "‹ Previous 1 … 46 47 48 49 Page 50" in the "pager"
    And I should not see the link "Next ›"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 45 46 47 48 Page 49 50" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 44 45 46 47 Page 48 49 50" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 43 44 45 46 Page 47 48 49 50" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 42 43 44 45 Page 46 47 48 49 50" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 41 42 43 44 Page 45 46 47 48 49" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 40 41 42 43 Page 44 45 46 47 48 … 50 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 39 40 41 42 Page 43 44 45 46 47 … 50 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 38 39 40 41 Page 42 43 44 45 46 … 50 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 37 38 39 40 Page 41 42 43 44 45 … 50 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 … 36 37 38 39 Page 40 41 42 43 44 … 50 Next ›" in the "pager"

  Scenario: Pager behaves correctly with less pages than pagination quantity (set to 9).
    Given "60" nodes of type "article"

    When I visit "/node"
    Then I should see "Page 1 2 3 4 5 6 Next ›" in the "pager"
    And I should not see the link "‹ Previous"

    When I click "Next ›"
    Then I should see "‹ Previous 1 Page 2 3 4 5 6 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 Page 3 4 5 6 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 Page 4 5 6 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 Page 5 6 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 5 Page 6" in the "pager"
    And I should not see the link "Next ›"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 3 4 Page 5 6 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 3 Page 4 5 6 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 Page 3 4 5 6 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 Page 2 3 4 5 6 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "Page 1 2 3 4 5 6 Next ›" in the "pager"
    And I should not see the link "‹ Previous"

  Scenario: Pager behaves correctly with less pages than pagination quantity (set to 9).
    Given "30" nodes of type "article"

    When I visit "/node"
    Then I should see "Page 1 2 3 Next ›" in the "pager"
    And I should not see the link "‹ Previous"

    When I click "Next ›"
    Then I should see "‹ Previous 1 Page 2 3 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 Page 3" in the "pager"
    And I should not see the link "Next ›"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 Page 2 3 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "Page 1 2 3 Next ›" in the "pager"
    And I should not see the link "‹ Previous"

  Scenario: Pager behaves correctly with no pages.
    Given "5" nodes of type "article"

    When I visit "/node"
    Then I should not see ".ecl-pager__wrapper"

  Scenario: Pager behaves correctly with the exact number of "quantity" pages (set to 9).
    Given "90" nodes of type "article"

    When I visit "/node"
    Then I should see "Page 1 2 3 4 5 6 7 8 9 Next ›" in the "pager"
    And I should not see the link "‹ Previous"

    When I click "Next ›"
    Then I should see "‹ Previous 1 Page 2 3 4 5 6 7 8 9 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 Page 3 4 5 6 7 8 9 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 Page 4 5 6 7 8 9 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 Page 5 6 7 8 9 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 5 Page 6 7 8 9 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 5 6 Page 7 8 9 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 5 6 7 Page 8 9 Next ›" in the "pager"

    When I click "Next ›"
    Then I should see "‹ Previous 1 2 3 4 5 6 7 8 Page 9" in the "pager"
    And I should not see the link "Next ›"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 3 4 5 6 7 Page 8 9 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 3 4 5 6 Page 7 8 9 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 3 4 5 Page 6 7 8 9 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 3 4 Page 5 6 7 8 9 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 3 Page 4 5 6 7 8 9 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 2 Page 3 4 5 6 7 8 9 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "‹ Previous 1 Page 2 3 4 5 6 7 8 9 Next ›" in the "pager"

    When I click "‹ Previous"
    Then I should see "Page 1 2 3 4 5 6 7 8 9 Next ›" in the "pager"
    And I should not see the link "‹ Previous"

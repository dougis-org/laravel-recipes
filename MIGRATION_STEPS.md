# MIGRATION_STEPS.md

## Laravel 5.x to 11.x Migration Guide (laravel-recipes)

This document outlines the remaining steps and patterns to follow for a consistent, safe, and modern upgrade of the codebase. Use this as a reference for all future migration threads.

---

## 1. Middleware Modernization

- **Location:** `app/Http/Middleware/`
- **Pattern:**
  - Use type hints for `$request` and `$next`.
  - Remove deprecated middleware signatures.
  - Ensure all middleware extends `Illuminate\Foundation\Http\Middleware` or implements `Middleware` contract as needed.
  - Register middleware in `app/Http/Kernel.php` using FQCN.

## 2. Controller & Request Modernization (COMPLETE for main controllers)

- **Pattern:**
  - Use constructor injection for dependencies.
  - Use type hints for all method parameters and return types.
  - Remove deprecated traits and base classes.
  - Use FQCN in routes.

## 3. Model Modernization (COMPLETE for main models)

- **Pattern:**
  - Use only `$fillable`, remove `$guarded`.
  - Remove legacy getter/setter methods.
  - Use FQCN for relationships.
  - Remove unnecessary docblocks.

## 4. Route Modernization

- **Location:** `routes/web.php`, `routes/api.php`, etc.
- **Pattern:**
  - All routes should use FQCN controller syntax: `Route::get('...', [Controller::class, 'method'])`.
  - Remove legacy `app/Http/routes.php` (after confirming all routes are migrated).
  - Use route groups and middleware as needed.

## 5. Exception & Handler Updates (COMPLETE)

- **Pattern:**
  - Use Laravel 11's `Handler.php` conventions.
  - Remove deprecated methods.

## 6. Config & Service Provider Updates (IN PROGRESS)

- **Pattern:**

  - Remove obsolete providers from `config/app.php`.
  - Use FQCN for all providers and aliases.
  - Update config files for new Laravel 11 options.

- **Status:**

  - Manual edits detected in `config/app.php`, `composer.json`, and several provider files. Review and modernization for Laravel 11 is in progress on branch `laravel11-config`.
  - All config files have been read and are being updated for compatibility.

- **Next Steps:**
  1. Complete review and modernization of all config files for Laravel 11 compatibility, ensuring no manual edits are lost.
  2. Commit, push, and open a PR to `main` from `laravel11-config`.
  3. Merge PR after review.
  4. Proceed to **Testing & Validation** (Step 7 below) in a new branch.

## 7. Testing & Validation

- **Pattern:**
  - Run `php artisan test` and resolve all errors.
  - Update tests to use modern PHPUnit and Laravel conventions.
  - Ensure no behavioral or schema changes.

## 8. Dependency & Security Checks

- **Pattern:**
  - After any `composer update` or package change, run security analysis (e.g., Trivy).
  - Address all vulnerabilities before proceeding.

## 9. Cleanup

- **Pattern:**
  - Remove all legacy/unused files (e.g., `app/Http/routes.php` after migration).
  - Remove deprecated code, comments, and docblocks.

---

## General Patterns

- **Type Hints:** Use strict type hints everywhere.
- **FQCN:** Always use fully qualified class names in routes, providers, and relationships.
- **No Deprecated Traits:** Remove all deprecated Laravel traits and base classes.
- **No Schema/Behavior Changes:** All migrations must preserve existing behavior and database schema.
- **Use MCP/Context7 Tools:** All file and shell operations must use the MCP server tools for consistency and auditability.

---

## Workflow for All Migration Phases

1. **Create a new branch** for your migration work (e.g., `laravel11-middleware`, `laravel11-config`, etc.).
2. **Perform the migration** following the steps and patterns in this document.
3. **Commit and push** your changes to the branch.
4. **Open a pull request (PR)** to `main` for review.
5. **Merge the PR** after review and validation.
6. **Repeat** for each migration phase or area.

## How to Use This Guide

- For any new migration thread, reference this file to ensure consistency.
- If you encounter a file or pattern not covered here, update this document.
- Always check for manual edits before making changes to a file.

---

### Last updated: August 31, 2025

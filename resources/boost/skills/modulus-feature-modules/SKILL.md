---
name: modulus-feature-modules
description: "Use when scaffolding or editing InEngine feature modules from module-skeleton: ModuleServiceProvider, publish/enable/seed, Composer deps reach-down, contracts/DTOs/events."
---

# Modulus feature modules

## Shape

- `inengine/{feature}` from this template; extend `ModuleServiceProvider`
- `resources/dist` for UI publish; idempotent migrations; confirming `ModuleSeeder`
- Folders: `src/Contracts`, `src/DataTransferObjects`, `src/Events`

## Lifecycle

Publish on install → enable (migrate) → optional confirmed seed. See `resources/ASSETS.md`, `DEPENDENCIES.md`, `INTEGRATION.md`.

## Dependencies

Modulus siblings must be enabled. Plain Composer packages: normal Laravel discovery; optional `bootstrapNonModulusDependencies()`.

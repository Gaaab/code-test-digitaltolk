# README

**Thoughts about the code**

- `BookingRepository.php`
    - File is too large (God Object) and will became harder maintain or add more feature.
    - Repository pattern concern be only for handling the data layer.
    - Refactoring the code might be result not be the solution right away as it might affect other logic dependent on it. However we can do is decouple the logic into its own concern.

- `BookingController.php`
    - Suggest that the business logic should be placed inside the service, for binding the repositories or any other services.
    - Requires more form requests class.

**How would you have done it**

- I suggest that we can put the resources into its own module (modular approach), instead of having large files that might become unstable to maintain.
- Apply usage of service layer for handling the business logics.
- Apply usage the framework's service providers for each modules for binding the services needed.

**Refactored Code**
`refactor/app/Repository/BookingRepository.php`
- Added query filters
- Added dto for parameter validations
- Added notification service example classes (not recommended but added comments)
- Added helpers to decouple simple logics

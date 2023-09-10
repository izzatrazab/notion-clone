# Notion Clone

Low fidelity MVP. The target is to somehow clone notion/clickup.

## The Defined Problems

1. Tend to forgot what tasks should be done.
2. Hard to keep track the order of completing the tasks (which one should be completed first).
3. Difficulty to track progress of each tasks.
4. Tend to forget who accountable for a specific task

## Functional Requirement

1. System able to create projects.
2. System able to add dates (deadline/period date).
3. System allow user to search through the project using search bar.
4. System allow user to assign tasks to someone else
5. System allow user to access to other pages using sidebar.

## Non Functional Requirement
kiv

## Languages/Framework/Database:
- Laravel (with Inertia)
- Scaffold using Laravel Jetstream
- Vue (typescript)
- vuetify
- Mysql (i used xampp)
- editorjs

## Diagrams
Click link below to view for some to view some diagrams in Draw io.
[link here](https://drive.google.com/file/d/1fpNaFeAKDJuzDsRZe9ZFfEPaYHBdg0O5/view?usp=sharing)

## Similar Application already available
1. Notion
2. Nuclino
3. Clickup

## Modules

| ✅ | Modules                   | Desc                                                          |
|  -  | -                         | -                                                             |
| ✅ | 🟢 Create Project         | project is like a list table                                  |
|     | 🟢 Create Project Template| can create table template with custom column (for project)    |
| ✅ | 🟢 Create Task            | task is like a list table but with checklist column           |
|     | 🟢 Create Task Template   | can create table template with custom column (for task)       |
|     | 🟡 Task Flow              | Some task need to done first before other task, flow here means to block certain task before specific task is completed   |
|     | 🟡 Task Pre Requisite     | related to task flow, requirement for a task to be available  |
|     | 🟢 User, Team             | project can has multiple member                               |
|     | 🟢 PIC, Team lead, (role) | role of each member in a project (eg. admin, editor, viewer)  |
|     | 🟢 Add, remove members    | add new member or remove member                               |
|     | 🟢 Notification           | probably just email notification                              |
|     | 🟢 Client                 | hmmm ????                                                     |
| ✅/2| 🔴 Diagram editor         | probably gantt chart                                          |



### Memo Module
list of editor js tools used
1. header ✅
3. nested-list ✅
4. nested checklist ✅
5. table ✅

### Project Module

